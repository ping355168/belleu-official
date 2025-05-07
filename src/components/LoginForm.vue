<template>
    <main>
        <header>
            <img src="/image/swiper-1.png" alt="belleu-logo" class="belleu-logo">
        </header>
        <article>
            <section class="login-form">
                <h2>登入帳號</h2>
                <form @submit.prevent="handleLogin">
                    <div>
                        <label>Email</label>
                        <input v-model="email" type="email" required />
                    </div>

                    <div>
                        <label>密碼</label>
                        <input v-model="password" type="password" required />
                    </div>

                    <p v-if="errorMsg" class="error">{{ errorMsg }}</p>

                    <button type="submit" :disabled="isLoading">
                        <span v-if="isLoading">🔒 登入中...</span>
                        <span v-else>登入</span>
                    </button>
                </form>
            </section>
        </article>

    </main>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'

const router = useRouter()

const email = ref('')
const password = ref('')
const errorMsg = ref('')
const isLoading = ref(false)

const handleLogin = async () => {
    errorMsg.value = ''
    isLoading.value = true

    if (!email.value || !password.value) {
        errorMsg.value = '請填寫所有欄位'
        isLoading.value = false
        return
    }

    try {
        const res = await axios.post('http://localhost/belleu/api/login.php', {
            email: email.value,
            password: password.value,
        })

        if (res.data.success) {
            localStorage.setItem('user', JSON.stringify(res.data.user))

            await Swal.fire({
                icon: 'success',
                title: '登入成功',
                text: '歡迎回來 ☕',
                timer: 1800,
                showConfirmButton: false
            })

            router.push('/')
        } else {
            errorMsg.value = res.data.message || '帳號或密碼錯誤'
        }

    } catch (err) {
        errorMsg.value = '伺服器錯誤，請稍後再試'
        console.error(err)

    } finally {
        isLoading.value = false
    }
}

</script>

<style scoped>
header {
    width: 50vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    overflow: hidden;
}

article {
    width: 50vw;
    display: flex;
    justify-content: center;
}

main {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-form {
    max-width: 400px;
    width: 100%;
    padding: 40px 32px;
    border: 1px solid #eee;
    border-radius: 16px;
    background-color: #fffdfc;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #4B4237;
    font-size: 22px;
    font-weight: bold;
}

form div {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #4B4237;
    font-size: 14px;
}

input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
    background-color: #fdfdfd;
    box-sizing: border-box;
}

input:focus {
    border-color: #E5AAA3;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #E5AAA3;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 12px;
}

button:hover {
    background-color: #d88f88;
}

.error {
    color: #d84040;
    background-color: #ffecec;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    margin-bottom: 16px;
    text-align: center;
}
</style>