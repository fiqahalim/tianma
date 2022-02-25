## System Requirements
- PHP version ^7.3 | >= 8.0

## Installation Instrustion
### Deployment
1. Clone this project to your folder you want

2. Run `cp .env.example .env` file to copy example file to `.env`

     Then edit your .env file with DB credentials and other settings.
     
3. Run `composer install` command, after that run `npm install` and `npm run dev`.

4. Run `php artisan migrate --seed` command.

    Notice: seed is important, because it will create the first admin user for you.
    
5. Run `php artisan key:generate` command.

6. If you have file/photo fields, run `php artisan storage:link` command.

And that's it, go to your domain and login:

### Default credentials
Username: `admin@admin.com`

Password: `password`

#### Main Page
<img src="https://user-images.githubusercontent.com/93239445/155712777-f7f30b50-be94-4c24-bd39-c4bf4c3c0383.png" width="550" height="320">

<img src="https://user-images.githubusercontent.com/93239445/155712896-1b5935e8-089d-4ee6-83a1-d95404391049.png" width="550" height="320">

#### Admin Site
- Able to view all agent's hierarchy
- Make new product purchase for agents
- View all orders, commissions by monthly

<img src="https://user-images.githubusercontent.com/93239445/155713083-abada779-2a07-48a1-a7ca-ef66aa3866d7.png" width="550" height="320">

<img src="https://user-images.githubusercontent.com/93239445/155713443-fd4cc850-a2a3-4696-b44b-fe5aeee624a4.png" width="550" height="320">

<img src="https://user-images.githubusercontent.com/93239445/155713505-08438771-df33-4c3b-832d-9e594e4b3ab8.png" width="550" height="320">

<img src="https://user-images.githubusercontent.com/93239445/155714552-862f7254-99c5-4a47-bc32-229925a731dc.png" width="550" height="320">

#### Agent Site
- View their own commissions by monthly
- Able to register downline, and view downline
- Upload requirements documents for admin's view
<img src="https://user-images.githubusercontent.com/93239445/155714007-93a7a998-a08d-4b29-88aa-655f97c894a5.png" width="550" height="320">

<img src="https://user-images.githubusercontent.com/93239445/155714041-8d1f41a0-e373-4b69-b6ae-30ca8257127a.png" width="550" height="320">

<img src="https://user-images.githubusercontent.com/93239445/155714215-5c203c03-a2c7-4e91-80dd-d58e527ffd7c.png" width="550" height="320">
