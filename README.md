# Reborn
Reborn is chatting app. This is my first big project (by my standards)

___
## The application features:
- authorization
- sending and reviewing message requests
- communication
- email verification
- password resetting
___
## How to start
To get started, follow the instructions:
- Create new account or sign in if you already have one
- Go to the main chat page
- Find the "Add Friend" button and click on it
- Input your friend username in following field 
- Press enter

Next, your friend will receive a message with a request. If he accepts your request, the chat will be created immediately. Users can create many chats among themselves.

In addition, you can delete chats. Hover over the desired chat in the chat list, you will see a cross. If you press it, the chat is deleted permanently


___

## How to run this project:

Install dependencies:

```
    composer install
```
```
    npm install
```

#### Configure .env file. Database, mail and pusher configuration required!

Generate laravel app key:
```
    php artisan key:generate
```
Run migrations:
```
    php artisan migrate
```
*(optional) Run local server
```
npm run dev
php artisan serve
```
