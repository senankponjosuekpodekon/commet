# COMMET project
Welcome -and thank to join this project. This readme is a guide to help you test or participate to this project; the one is about set up  web application to comment everything on internet. This repository is also configured to allow working on his differents parts completely independant.
***
***
## Prerequisites
-   Laravel 11, php 8.3.9 and Composer
-   Docker 

## Considerations
As mentionned previously, the base project is configured to make integrations and team work easier. We have set up a continuous CI/CD integration and deployment process. This is a combination of processes and practices that work together to continuously integrate, test and deploy code changes in production. 

## Organisation 
This project is made up two parts: the frontend materialized by the frontend folder and the backend materialize by the backend folder. Both are inside the app folder, representing the folder for the whole project. 

The backend folder contains all the files and folders required for a laravel project. 
To manage posts and comments CRUD, we've set up an api that will later interact with the frontend of this project.
- the posts CRUD is manage by the PostController,
- the comments CRUD is manage by the CommentController both on the controller folder.


## Getting started 
Firt, you will have to clone the project from github.

Then, move into the "app/" folder
### Backend part

1) We recommend to change the directory to backend and then enter the command:
    ```
    composer install
    ```
to install the dependencies of the project.

2) Once you'll have installed the dependencies you will have to turn in a .env file at the root of backend folder. You can inspire yourself from the .env.example and modify the database part by filling the following values with yours. Then you will have a .env file and a .env.example fields at the root of backend:

    ```
    DB_CONNECTION=your DB_SERVER  (ex: sqlite, mariadb...)
    DB_HOST=your DB_HOST
    DB_PORT=your DB_PORT
    DB_DATABASE=your DB_NAME
    DB_USERNAME=your DB_USERNAME
    DB_PASSWORD=your DB_PASSWORD

    ```


3) After having turned in your .env file, you can run 
    ```
    php artisan key:generate

    ```
to generate the app key.

4) Now, run  
    ```
    php artisan migrate 

    ```
to generate the database and its tables

5) Finally, run  
    ```
    php artisan serve 

    ```
    to start the project


### Frontend part

1) We recommend to change the directory to frontend and then enter the command:
    ```
    npm install
    
    ```
to install the dependencies of the project.

2) Finally, run  
    ```
    npm run build 

    ```
    to start the project

## Usage

### Signup

To signup on COMMET, go to the registration page, insert required information. The age is between 13 and 35.
### Signin
### Post
### Comment
### Dashboard

## Deployment

The instructions to deploy the web application in production will be added soon.

## Contribution

Contributions are welcome ! Please submit pull requests and open issues for all improvement or bug encontrered.

## Licence

This project is under licence [MIT](LICENSE).
