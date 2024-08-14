
<!--- Movies API Website --->

# Movies API Application 

The TMDB (The Movie Database) Movie API website is an online platform that allows users to explore a vast collection of movies and TV shows. Leveraging the powerful TMDB API, the website provides detailed information about films, including synopses, cast and crew details, ratings, trailers, and more. Users can search for specific titles, browse by genre or popularity, and discover new movies and shows.

## Usage 

### Search and Discovery:

- **Search by Title:** Users can search for movies and TV shows by entering a title in the search bar. The application fetches matching results from the TMDB API, providing quick access to details about each title.

- **Browse by Genre or Category:** Users can explore content by browsing through genres, popular movies, top-rated films, or upcoming releases, all sourced from the API.

### Detailed Information:

- **Movie/TV Show Details:** For each title, the application displays comprehensive information, including the synopsis, release date, cast and crew, trailers, and ratings.

- **Cast and Crew Profiles:** Users can click on a cast or crew member to view their full profile, which includes a list of movies or shows they've been involved with.

### User Interaction:

- **Ratings:** Users can see ratings for each title, helping them make informed viewing choices.

### Integration:

- **API Integration:** The website seamlessly integrates with the TMDB API to fetch real-time data, ensuring that users always have access to the latest movie and TV show information.

### Viewing Movie Details

- When a movie is selected from the search results, the application checks the movie table for detailed information. If the movie exists, it displays the details from the database. If the movie does not exist, it fetches the details from the API, displays them, and stores the record.

### Logging

- The application logs significant events, including storing all movie and TV show data, job failures, and cron job activities. Logs can be found in `storage/logs/laravel.log`.

# Initial Setup 

## Requirements

- PHP >= 8.1
- Laravel >= 10
- MySQL 

## Application Setup Instructions

1. **Clone Repository:**  
    ```bash
    git clone https://github.com/Sanjay-i/movie_api_website.git 
    ```
 2. **Switch to the Repository Folder:**
    ```bash
    cd movies_website
    ```

 3. **Copy the example env file and make the required configuration changes in the .env file:**
    ```bash
    cp .env.example .env
    ```

Create the Movie Database and Connect the Database Name in the .env File.

# Install Dependencies:

1. **Install Composer Dependencies:**
    ```bash
    composer install
    ```
2. **Run Migration Command to Create All Tables:**
    ```bash  
    php artisan migrate
    ```
3. **Start your build process Command:**
    ```bash  
    npm run dev
    ```

## Tmdb API Integration 

The TMDB (The Movie Database) Movie API is a powerful and comprehensive web service that allows developers to access and interact with a vast collection of movie, TV show, and celebrity data.and searching 

## movies and tv show details 

When a user searches for a movie or TV show in our application, the system first checks the database for the selected title. If the data is found, it displays the saved information on the movies and TV shows page. If the data is not available in the database, the system fetches the information from the API and displays it on the page.



## Queue Job

- Laravel's queue system is used in this application in order to efficiently handle background processing tasks. When a movies or tv shows  detail is not found in the database, a queue job is automatically triggered to fetch the details from the tmdb movie API and store them in the database. As a result, the application is responsive to user actions while handling potentially time consuming functions in the background, thus ensuring that the application remains responsive to user actions.

  ```bash
    php artisan queue:work
  ```
- The logs/laravel.log file displays all log errors, allowing us to identify where the errors occur in the code. This is particularly advantageous when working with the queue concept.

