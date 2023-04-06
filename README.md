## Description

The application consisted in symulating the movie rental system. Registered users can rent any film for a period of 2 days at any time. The application allows the user to manage his resources by changing his data, topping up the virtual wallet with appropriate funds to rent movies and displaying a list of his currently rented movies. After renting a movie, the user has the option to watch it. The application also has administrators who can manage users and videos. The application was created in the MVC architecture (Model, View, Controller).

## Technologies

Laravel, BootStrap, HTML, CSS, MySQL, JavaScritp (libraries: OwlCarousel2, ChartJS)

## Installation

1. Change the `.env.example` configuration file extension to `.env`
2. Enter your MySQL database username and password in `.env` file. Default configuration:

```
DB_USERNAME=root
DB_PASSWORD=
```

3. Create a new database with the name `vod` encoded `uff8mb4_polish_ci`
4. In the terminal, execute the commands
    - `composer install --no-interaction`
    - `php artisan storage:link`
    - `php artisan migrate`
    - `php artisan db:seed`
    - `php artisan serve`
5. Run the application in the browser by entering the address:

```bash
localhost:8000
```

## Screenshots

![image](https://user-images.githubusercontent.com/41111309/230365339-26268c26-6b48-4929-b970-847f0dfada51.png)
![image](https://user-images.githubusercontent.com/41111309/230365607-d3535f1b-c02c-4491-b2e6-edb265521940.png)
![image](https://user-images.githubusercontent.com/41111309/230365921-e335c397-9faa-47b1-9e48-358495edfb36.png)
![image](https://user-images.githubusercontent.com/41111309/230365977-d9183ce6-cf1f-4a33-bfc6-77f81daff5cb.png)
![image](https://user-images.githubusercontent.com/41111309/230366199-5c50b109-475c-43df-990b-4e9b325503fc.png)
![image](https://user-images.githubusercontent.com/41111309/230366305-fd1f48db-d1f4-4af7-83b1-0f7a983a2806.png)
![image](https://user-images.githubusercontent.com/41111309/230366360-047f8aa4-886f-473e-aea0-75081ac82701.png)
![image](https://user-images.githubusercontent.com/41111309/230366581-ac06c00d-e771-44bc-8226-e363430ecb7f.png)
![image](https://user-images.githubusercontent.com/41111309/230366674-2240e6e5-3bfc-443e-a132-b49ad9492c4b.png)
![image](https://user-images.githubusercontent.com/41111309/230366853-1e05b092-c744-46d2-9022-6ff237059f10.png)
![image](https://user-images.githubusercontent.com/41111309/230366954-fbc9643e-d7c8-4bec-a033-4479d96b3411.png)
![image](https://user-images.githubusercontent.com/41111309/230367019-e15f3485-b438-4cc5-b310-a12ac1257942.png)
![image](https://user-images.githubusercontent.com/41111309/230367206-41dff1c3-9759-415b-b387-521b77c8c167.png)
