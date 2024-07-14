# SelBuy 🛒

SelBuy is a dynamic online marketplace inspired by platforms like Avito.ma and Facebook Marketplace. It allows users (sellers) to post announcements containing the products they want to sell, and other users (sellers/buyers) can contact them using email, phone, or chat inside the app.

## Features ✨

- 📢 **Announcement Posting:** Sellers can create detailed announcements for the products they wish to sell.
- 📬 **Contact Options:** Buyers and sellers can communicate via email, phone, or an integrated chat system.
- 💻 **User Interface:** Modern and responsive design with interactive elements.
- 📊 **Data Visualization:** Utilize charts for data representation.

## Technologies Used 💻

- **HTML, CSS:** Structure and styling of web pages. ![HTML5](https://img.shields.io/badge/-HTML5-E34F26?logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/-CSS3-1572B6?logo=css3&logoColor=white)
- **JavaScript:** Dynamic and interactive web pages. ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?logo=javascript&logoColor=black)
- **jQuery:** Simplified DOM manipulation and animations. ![jQuery](https://img.shields.io/badge/-jQuery-0769AD?logo=jquery&logoColor=white)
  - **jQuery UI:** Interactive widgets for user interfaces.
  - **Easing JS:** Smooth animations for visual effects.
  - **jQuery Migrate JS:** Compatibility with older versions of jQuery.
  - **ScrollUp JS:** Scroll-to-top functionality.
  - **jQuery Nav JS:** Interactive and responsive navigation.
- **Tailwind CSS:** Utility-first CSS framework for rapid and responsive design. ![Tailwind CSS](https://img.shields.io/badge/-Tailwind%20CSS-38B2AC?logo=tailwind-css&logoColor=white)
- **DataTable:** Interactive and dynamic tables.
- **Alpine JS:** Reactive and lightweight components for the frontend. ![Alpine JS](https://img.shields.io/badge/-Alpine%20JS-8BC0D0?logo=alpine.js&logoColor=black)
- **FontAwesome:** Vector icons for an enriched user interface. ![FontAwesome](https://img.shields.io/badge/-Font%20Awesome-528DD7?logo=font-awesome&logoColor=white)
- **Animate.css:** CSS animations library for visual effects.
- **FlowBite:** UI components integrated with Tailwind CSS.
- **SweetAlert2:** Stylish alerts for better user interaction.
- **UI Avatar:** Dynamic user avatar generation.
- **Laravel Charts:** Data visualization with charts.
- **Laravel (PHP):** Web framework for a robust MVC structure and advanced features. ![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?logo=laravel&logoColor=white)
- **Vite JS:** Fast compilation and development tool for modern applications. ![Vite](https://img.shields.io/badge/-Vite-646CFF?logo=vite&logoColor=white)

## Getting Started 🚀

### Prerequisites

Before you begin, ensure you have met the following requirements:

- You have installed [Composer](https://getcomposer.org/) ![Composer](https://img.shields.io/badge/-Composer-885630?logo=composer&logoColor=white)
- You have installed [Node.js and npm](https://nodejs.org/) ![Node.js](https://img.shields.io/badge/-Node.js-339933?logo=node.js&logoColor=white) ![npm](https://img.shields.io/badge/-npm-CB3837?logo=npm&logoColor=white)
- You have a working [PHP](https://www.php.net/) environment ![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=white)

### Installation 🛠

Follow these steps to set up the project locally:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/YoussefSelk/SB-SelBuy.git
    cd SB-SelBuy
    ```

2. **Install Composer dependencies:**
    ```bash
    composer install
    ```

3. **Install npm dependencies:**
    ```bash
    npm install
    ```

4. **Set up the environment variables:**
    Copy the `.env.example` file to `.env` and update the configuration as needed.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Run the database migrations:**
    ```bash
    php artisan migrate
    ```

6. **Seed the database :**
    ```bash
    php artisan db:seed
    ```

### Running the Project 🏃‍♂️

1. **Start the PHP development server:**
    ```bash
    php artisan serve
    ```

2. **Compile the frontend assets:**
    ```bash
    npm run dev
    ```

Your application should now be running at `http://localhost:8000`.

## Contributing 🤝

To contribute to SelBuy, follow these steps:

1. Fork this repository.
2. Create a branch: `git checkout -b feature/your-feature`.
3. Make your changes and commit them: `git commit -m 'Add some feature'`.
4. Push to the original branch: `git push origin feature/your-feature`.
5. Create the pull request.

## License 📜

This project is licensed under the [MIT License](LICENSE).

## Contact 📧

If you want to contact me, you can reach me at [youssefselk.dev@gmail.com](mailto:youssefselk.dev@gmail.com).
