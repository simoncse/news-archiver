
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <link rel="icon" type="image/png" href="/assets/favicon.png" />
    <link rel="stylesheet" href="css/main.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>FlashBack News</title>
</head>

<body>
    <nav>
        <div class="container">
            <div class="logo">
                <h3> <img src="assets/fbn_logo.svg" alt="logo"> </h3>

                <div class="burger" id="burger">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
</svg>
                </div>
            </div>

            <ul class="site-links">
            <li>
                <a href="/" class="nav-link">home</a>
            </li>
            <li>
                <a href="/about" class="nav-link">about</a>
            </li>

            
            <li>
            <a href="/development" class="nav-link">development</a>
            </li>
            <li>
                <a href="/contact" class="nav-link">contact</a>
            </li>
            </ul>



            <form class="selection__form" id="search" submit="" method="get">

                <div class="channel__options">
                    <p>news channels</p>
                    <div class="checkbox-group">
                        <label>Fox News</label>
                        <input class="checkbox" type="checkbox" checked name="channels[]" value=1>
                    </div>
                    <div class="checkbox-group">

                        <label>CNN</label>
                        <input class="checkbox" type="checkbox" checked name="channels[]" value=2>

                    </div>
                </div>


                <div class="date__options">
                    <div class="datepicker__wrapper">
                        <input type="text" class="datepicker" id="datePicker" value=''
                            placeholder="Select Date..">
                    </div>

                    <div class="select__wrapper">
                        <select name="entry_uid" id="timeslots" required>
                            <option disabled default selected value="">Select a time:</option>
                        </select>
                    </div>

                <button type="submit" class="btn btn-search">Search</button>
                </div>
            </form>
        </div>
    </nav>

    <main class="container">
        <div class="row">
            {{content}}
        </div>

    </main>

 <?php include_once("footer.php") ?>

    <script src="js/burger.min.js"></script>
    <script src="js/index.min.js"></script>
</body>


</html>