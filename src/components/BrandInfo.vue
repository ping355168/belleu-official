<template>
    <!-- 品牌資訊區塊 -->
    <section class="brand-info">

        <!-- 左側：文字資訊 -->
        <div class="brand-left">
            <div class="brand-details">
                <h2>品牌資訊</h2>
                <p>店家名稱：BELLEU 比露時尚潮流服飾</p>
                <p>地址：新北市板橋區啟時時尚街117號4樓（板橋大遠百4樓）</p>
                <p>連絡電話：(TID)102-11-8939</p>
                <p>營業時間：</p>
                <ul>
                    <li>平日：13:00-22:00</li>
                    <li>假日：10:00-24:00</li>
                </ul>
            </div>
        </div>

        <!-- 右側：嵌入 Google 地圖 -->
        <div class="brand-map">
            <iframe src="https://www.google.com/maps/embed?pb=..." allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</template>

<style scoped>
.brand-info {
    background-color: #F6F4EE;
    display: grid;
    gap: 20px;
    padding: 80px 150px;
}

.brand-left {
    display: flex;
    flex-direction: column;
}

.brand-details {
    color: #4B4237;
    line-height: 1.8;
    font-size: 16px;
}

.brand-details h2 {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 12px;
}

.brand-details ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* app 區域 */
.brand-app-download .app-title {
    font-size: 18px;
    font-weight: bold;
    color: #4B4237;
}

.app-title {
    margin: 12px 0px;
}

.brand-app-download {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.app-download-wrap {
    display: flex;
    align-items: center;
    gap: 20px;
}

.app-image {
    width: 100px;
    object-fit: contain;
}

.app-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.download-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #E5AAA3;
    color: white;
    text-decoration: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    transition: background-color 0.3s ease;
}

.download-btn:hover {
    background-color: #d28d89;
}

/* 地圖 */
.brand-map {
    width: 100%;
    height: 320px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
}

.brand-map iframe {
    width: 100%;
    height: 100%;
    border: none;
}
</style>