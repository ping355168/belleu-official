<template>
    <main>
        <header>
            <img src="/image/swiper-1.png" alt="belleu-logo" class="belleu-logo">
        </header>
        <article>
            <section class="register-form">
                <h2>註冊帳號</h2>
                <form @submit.prevent="handleRegister">
                    <div>
                        <label>Email</label>
                        <input v-model="email" type="email" required />
                    </div>

                    <div>
                        <label>密碼</label>
                        <input v-model="password" type="password" required minlength="6" />
                    </div>

                    <p v-if="errorMsg" class="error">{{ errorMsg }}</p>
                    <button type="submit">註冊</button>
                </form>
            </section>
        </article>
    </main>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import Swal from 'sweetalert2'

const router = useRouter()

const email = ref('')
const password = ref('')
const errorMsg = ref('')

const handleRegister = async () => {
    errorMsg.value = ''

    try {
        // 👉 註冊請求
        const res = await axios.post('http://localhost/belleu/api/register.php', {
            email: email.value,
            password: password.value,
        })

        if (res.data.success) {
            // 👉 自動登入
            const loginRes = await axios.post('http://localhost/belleu/api/login.php', {
                email: email.value,
                password: password.value,
            })

            if (loginRes.data.success) {
                // 👉 儲存登入狀態
                localStorage.setItem('user', JSON.stringify(loginRes.data.user))

                // 👉 顯示登入成功提示
                await Swal.fire({
                    icon: 'success',
                    title: '註冊後將自動登入！',
                    text: '歡迎來到 BELLEU ❤️',
                    timer: 1800,
                    showConfirmButton: false
                })

                // 👉 跳轉首頁
                router.push('/')
            } else {
                errorMsg.value = '自動登入失敗，請手動登入'
            }

        } else {
            errorMsg.value = res.data.message || '註冊失敗'
        }

    } catch (err) {
        errorMsg.value = '伺服器錯誤，請稍後再試'
        console.error(err)
    }
}
</script>



<style scoped>
header {
    width: 50vw;
    height: 100%;
    display: flex;
    justify-content: center;
    overflow: hidden;
}

.belleu-logo {
    box-sizing: border-box;
    height: 100%;
}

article {
    width: 50vw;
    display: flex;
    justify-content: center;
}

main {
    height: 100vh;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 30px;
}

.register-form {
    width: 50vw;
    max-width: 450px;
    padding: 40px 32px;
    border: 1px solid #e5e5e5;
    border-radius: 16px;
    background-color: #fffdfc;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    box-sizing: border-box;
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
