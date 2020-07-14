# Laravel Calendar App

Test project for Factory WorldWide.

## Installation

Once this project is cloned, recursevly, by the command:
```bash
git clone --recursive https://github.com/nikola91okbs/fullcalendar.git
```

The project is ready to be initialzed. Run bash file, ./init.sh.
```bash
bash init.sh
```

It will install Docker, if it is not already installed, configure whole application and run it.

## Usage

Create a profile or two, and you can start poplating event planner.

## Explanation of the code
Project uses PHP framework Laravel alongside with JWT token authentication and Laradock, Docker setup for Laravel.

It also uses Fullcalendar.io package, Bootstrap modal's alongside with a JQuery, to display the calendar.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

##Final notes
I was not sure what was required, specially in regards to JWT, should I implement it in cookies or session, or to leave it in the GET parameter, which I did.
I can use it in headers, but it is not seems like the best idea.

So I did what I did, if needed I can change it, it is no problem.

All the best!

With regards,

Nikola V.

## License
[MIT](https://choosealicense.com/licenses/mit/)
