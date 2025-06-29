# 🧠 DBTalker Magento 2 Extension

**Talk to your Magento 2 store database using natural language!**  
This extension integrates your store with the [DBTalker](https://dbtalker.com) platform to help admins query the database using AI without writing SQL.

---

## 🚀 Features

- Ask natural language questions (e.g., "Show most sold product last month")
- DBTalker AI translates queries into SQL + returns readable results
- Secure sync of your Magento database schema
- Easy admin configuration with API key
- Embedded chatbot inside Magento Admin Panel

---

## 🧩 Requirements

- Magento 2.4.x or above  
- PHP 8.1 or higher  
- An active [DBTalker](https://dbtalker.com) account

---

## 🔧 Installation (Manual)

1. Clone or download this repository  
   and place the extension under:

   app/code/DBTalker/Chatbot


2. Run Magento CLI commands:

php bin/magento setup:upgrade

php bin/magento setup:di:compile

php bin/magento module:enable DBTalker_Chatbot

php bin/magento setup:static-content:deploy

php bin/magento cache:flush


⚙️ Configuration Steps
1. Login to Magento Admin Panel

2. Navigate to: Stores → Configuration → DBTalker

3. Enter the DBTalker API Key
(Available after registering your platform at dbtalker.com)

4. Click Sync Schema — this syncs your DB structure to DBTalker

5. Navigate to DBTalker Chatbot in Admin panel

6. Start asking natural language queries!