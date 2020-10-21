# Sample of CRUD web app.

Simple "task manager". You can add, remove, edit tasks and mark them as completed.
Several statistic values are displayed on main page (total tasks, total done, average/most/least time spent to complete task and chart with tasks done count for last 7 days).
Simple auth and GitHub OAuth (to use it you should register github app and fill details into .env file).
Code split to different small classes and methods so its parts could be used as modules and implemented (maybe with a little changes cause of lack of time) to another code structure, and it's easier to maintain.
Most non-obvious methods have DocBlocks.

Were used:
- Backend:
  - Base Laravel framework v8.10
  - Laravel mix
  - Socialite package for Laravel
  - PHP 7.3
  - MySQL 5.7
- Frontend:
  - Bootstrap v4.5
  - Font awesome
  - Chart JS
  - jQuery v3.5.1
- Laravel debugbar and ide-helper for development
