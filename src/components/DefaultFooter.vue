<template>
    <!-- 網站頁尾 -->
    <footer>

        <!-- 上半部：網站導覽與聯絡資訊 -->
        <section>
            <!-- 導覽連結清單 -->
            <nav>
                <ul class="nav-list">
                    <li><router-link to="#" class="nav-link">關於比露</router-link></li>
                    <li><router-link to="#" class="nav-link">會員福利</router-link></li>
                    <li><router-link to="#" class="nav-link">使用條款</router-link></li>
                    <li><router-link to="#" class="nav-link">隱私權政策</router-link></li>
                    <li><router-link to="#" class="nav-link">門市資訊</router-link></li>
                </ul>
            </nav>

            <!-- 聯絡資訊 -->
            <div class="contact">
                <address class="footer-contact">
                    客服中心：(TID)102-11-8939<br />
                    電子郵件：service@belleu.com.tw
                </address>
                <address class="footer-contact">
                    平日（週一至週五）13:00-22:00<br />
                    例假日（週六、週日及國定假日）10:00-24:00
                </address>
            </div>
        </section>

        <!-- 下半部：品牌名稱與網站聲明 -->
        <aside>
            <div class="footer-brand">
                <h2 class="brand-name">BELLEU</h2>
                <h3 class="brand-subtitle">比露服飾無限公司</h3>
            </div>
            <div class="footer-disclaimer">
                本網站僅供網站設計學習用途，如有侵權請聯絡 ping355168@gmail.com
            </div>
        </aside>

    </footer>
</template>

<style scoped>
footer {
    color: white;
    background-color: #A49694;
    padding: 40px 100px;
}

.nav-list {
    display: flex;
    flex-direction: row;
    gap: 10px;
}

.nav-link {
    color: white;
    font-size: 18px;
    text-decoration: none;
}

.footer-brand {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
}

.brand-name {
    font-family: gaegu;
    font-size: 36px;
}

.brand-subtitle {
    font-size: 18px;
}

.footer-contact {
    font-size: 16px;
}

.footer-disclaimer {
    font-size: 16px;
}

section {
    display: flex;
    justify-content: space-between;
}

aside {
    margin-top: -40px;
}

.contact {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>