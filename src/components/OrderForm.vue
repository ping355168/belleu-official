<template>
  <main>
    <div class="checkout-container">
      <h1 class="title">結帳資訊</h1>

      <!-- 訂單明細 -->
      <div class="section">
        <h2>🛒 訂單明細</h2>
        <ul class="item-list">
          <li v-for="(item, index) in cartItems" :key="index" class="item">
            <img :src="item.image" alt="商品圖" class="item-image" />
            <div class="item-info">
              <p class="name">{{ item.name }}</p>
              <p class="detail">尺寸：{{ item.selectedSize }}　顏色：{{ item.selectedColor }}　數量：{{ item.quantity }}</p>
            </div>
            <div class="price">NT${{ item.price * item.quantity }}</div>
          </li>
        </ul>
      </div>

      <!-- 表單區 -->
      <div class="section">
        <h2>📦 收件資訊</h2>
        <form @submit.prevent="submitOrder" class="form">
          <div class="form-group">
            <label>姓名</label>
            <input v-model="form.name" type="text" placeholder="請輸入姓名" required />
          </div>
          <div class="form-group">
            <label>手機</label>
            <input v-model="form.phone" type="tel" placeholder="請輸入手機號碼" required />
          </div>
          <div class="form-group">
            <label>地址</label>
            <input v-model="form.address" type="text" placeholder="請輸入收件地址" required />
          </div>
          <button type="submit" class="submit-btn">送出訂單</button>
        </form>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import Swal from 'sweetalert2'

const cart = useCartStore()
const cartItems = computed(() => cart.items)


const form = ref({
  name: '',
  phone: '',
  address: '',
  email: 'test@example.com'  // ✅ 暫時寫死（先測通流程）
})

const submitOrder = async () => {
  if (cartItems.value.length === 0) {
    Swal.fire('購物車是空的', '請先選購商品再結帳～', 'warning')
    return
  }

  try {
    const response = await fetch('http://localhost/belleu/api/place_order.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        name: form.value.name,
        phone: form.value.phone,
        address: form.value.address,
        total: cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0),
        items: cartItems.value
      })
    })

    const result = await response.json()

    if (result.success) {
      Swal.fire('訂單完成', '感謝你的購買 💕 我們會盡快安排出貨！', 'success')
      cart.clear()
    } else {
      Swal.fire('提交失敗', result.message || '請稍後再試', 'error')
    }
  } catch (error) {
    console.error('送出訂單失敗', error)
    Swal.fire('發生錯誤', '請確認網路連線或聯繫客服', 'error')
  }
}

</script>

<style scoped>
main {
  padding: 40px 0px;
}

.checkout-container {
  max-width: 700px;
  margin: 60px auto;
  padding: 40px;
  background: linear-gradient(145deg, #fff8f8, #fff);
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
  font-family: "Noto Sans TC", sans-serif;
}

.title {
  font-size: 30px;
  font-weight: bold;
  margin-bottom: 30px;
  color: #d97373;
  text-align: center;
}

.section h2 {
  margin-bottom: 20px;
}

.section {
  margin-bottom: 40px;
}

.item-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.item {
  display: flex;
  align-items: center;
  margin-bottom: 16px;
  padding: 14px;
  border-radius: 12px;
  background-color: #fef3f3;
  border: 1px solid #f5dcdc;
}

.item-image {
  width: 64px;
  height: 64px;
  border-radius: 8px;
  object-fit: cover;
  margin-right: 16px;
}

.item-info {
  flex: 1;
}

.name {
  font-weight: bold;
  color: #4B4237;
}

.detail {
  font-size: 14px;
  color: #7d6b63;
  margin-top: 4px;
}

.price {
  font-weight: bold;
  color: #e57c7c;
  font-size: 15px;
}

.form-group {
  margin-bottom: 18px;
}

label {
  display: block;
  margin-bottom: 6px;
  color: #444;
  font-weight: 500;
}

input {
  width: 100%;
  padding: 10px 14px;
  border-radius: 10px;
  border: 1px solid #ddd;
  font-size: 15px;
  background: #fff;
  transition: border-color 0.3s;
  box-sizing: border-box;
}

input:focus {
  border-color: #e5aaa3;
  outline: none;
}

.submit-btn {
  width: 100%;
  padding: 14px;
  background-color: #e57c7c;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 10px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  letter-spacing: 1px;
}

.submit-btn:hover {
  background-color: #d26666;
}

</style>
