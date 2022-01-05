<div class="devblog">
    <h3>Development</h3>
     
    <p> 
        Source code can be found <a href="https://github.com/simoncse/news-archiver" target="_blank">here</a>. It includes PHP backend code written in a MVC framework, as well as frontend stuff such as Javascript and SASS. 
    </p>
    <p>Below is a bird's-eye view of the application logic.</p>
    <div class="flowchart-container">
        <a href="https://raw.githubusercontent.com/simoncse/diagrams/f4026b55c265260b32f4eb16d6cd74eeec8d8396/flowcharts/flashbacknews.svg">
        <img src="https://raw.githubusercontent.com/simoncse/diagrams/f4026b55c265260b32f4eb16d6cd74eeec8d8396/flowcharts/flashbacknews.svg" alt="flowcharts">
        </a>
    </div>
    <p>
      The scraper is written in Python and it uses the <a href="https://playwright.dev/python/docs/intro", target="_blank">Playwright API</a> to take screenshots of news headlines every 30 minutes. The data is then saved to a PostgreSQL database which also process and transform data. The majority of the application logic happens inside the database and so I will explain it a bit more below.
</p>

    <h3>Why PostgreSQL</h3>
    <p>
        When I started out this project, I didn't have much hands-on experience of relational databases. I initally chose PostgreSQL because it seems to work well with Python - the language I had written the scraper in. More importantly though, since the scraped data will grow continuously, the application requires a database that can handles a high volume of both read and write operations. As I am building the backend and learning to use PostgresSQL, I am convinced that PostgresSQL is the right choice.
    </p>
    <p> 
        Since PostgreSQL is an object-relational database, it supports more complex data types and operations than MySQL. These includes data types like JSON and array, along with their relevant methods. Therefore, it is possible to write user-defined functions (procedural functions that can store variables and peform complex queries) that simply returns JSON data as query results.
    </p>

    <p> 
       Thanks to this feature, I can create the functions needed and put them in a schema called <i>webapi</i> (as shown in the flowchart). You can think of this schema as an REST JSON API endpoint accessed by the server side code (PHP in this case), which can serve the data almost immediately with minimal modification. Due to some of its responsiblities lifted, the server side language can instead deal with user input and errors. 
    </p>

    <h3>Nginx and PHP-FPM</h3>
    <p>
        From my research, it seems that PHP-FPM (PHP – FastCGI Process Manager) is a better option for higher performance and speed than mod_php module - the default module in Apache HTTP server. As for Nginx, it has a smaller overall resource footprint than Apache in most cases, and thus pairing it with PHP-FPM makes sense to me. The setup is not difficult (well, eventaully) but it does requires quite a few dependencies. That's why I am runnging each separately as a Docker container. It ensures the source code can be packaged and run consistently, as well as the flexiblility to opt out PHP and use another server-side language in the future. 
    </p>

    <p>
        I am not an expert on computer network and server adminstration, so take my opinion with a grain of salt. The source code also includes the setup of certbot and letsencrypt to enable HTTPS . Feel free to take a peak if you don't want to pay for SSL certifcate. 
    </p>

    <h3>Frontend</h3>
    <p>
        Client side code is quite straightforward. I use a lightweight datetime picker UI called <a href="https://flatpickr.js.org/", target="_blank">flatpickr</a>, and wrote the rest in plain Javascript. They are compiled by webpack, and eventually built into a Docker image run by Nginx. Same for SASS, except the files are compiled by dart-sass.

    </p>    
        <br>
        <br>
    <p>
        If you have any questions, feel free to contact me <a href="/contact" target="_blank">here </a>. 
        
        

    </p> 

</div>

<style>

.flowchart-container {
    width:100%;
    padding:1.5rem;
    text-align:center;
}

.flowchart-container img {
    width:80%;
}

code {
    font-family: monospace;
}

</style>
