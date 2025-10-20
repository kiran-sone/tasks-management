# Tasks Management: A Laravel 12 application

## Application Requirements
- Laravel version 12
- MySQL database (Server version: 10.6.7-MariaDB)
- tasks_management.sql file is available in this application package
- Configure/update .env as per your local environment setup
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3309
    DB_DATABASE=tasks_management
    DB_USERNAME=root
    DB_PASSWORD=
- Application makes use of AdminLTE.io theme


## Application Access:
http://127.0.0.1:8000/


## Application Features
- Create task (info to save: task name, project name, priority, timestamps(created/edited))
- View/Edit/Delete task
- Create/View/Edit/Delete project
- Pagination of tasks (Server side, ajax based, Laravel pagination)
- Filter tasks by project
- Reorder tasks with drag and drop feature. Priority should automatically be updated
- Reorder works over Task serial numbers (below # sign column in Manage Tasks page)
- Application screenshots are provided below

## Application Screenshots
<img width="1920" height="891" alt="Image" src="https://github.com/user-attachments/assets/cd9eaf1d-6c85-48b4-b3a9-f22035731546" />
<img width="960" height="437" alt="Image" src="https://github.com/user-attachments/assets/b9d9d4fa-5211-4109-98de-32d2eb874d00" />
<img width="960" height="506" alt="Image" src="https://github.com/user-attachments/assets/8d33ce1f-c0c1-43ca-aff5-3f7837eb7491" />
