<?php
$pageTitle = "Home Page";
include "header.php";
include "connect.php";
session_start();
?>

<body>

<header>
   
   
    <nav>
    <img class="logo" id="logo" src="../Images/Foodies love.jpg" alt="Logo"/>
        <a class="activeLink" href="#index">Home</a>
        <a href = "allRecipes.php">Recipes</a>
        <a>Tips</a>
        <a>About</a>
        <a >Contact</a>
        <?php if(isset($_SESSION['username'])): ?>
            <a href="recipeowner_dashboard.php" title="User Dashboard">Dashboard</a>
           
        <?php else: ?>
            <a href="loginForm.php" title="Login Page" target="_blank">Login</a>
        <?php endif; ?>
       
    </nav>
    
    <form class="form" action="/search">
        <div class="formGroup" id="search">
        <input type="text" placeholder="Recipes.." id="searchInput" name="searchInput">
        <input type="submit" value="Search" id="searchButton">
    </div>
      </form>
  
</header>
<?php if(isset($_SESSION['username'])): ?>
          
        <h3>  <?php echo "Welcome, ". $_SESSION['username']; ?> </h3>

      <?php endif; ?>
               <main>
                
                    <div class="trial">
                        <img class="Homephoto" src="../Images/Food photo.jpg" alt="Home Photo"/>
                        <div class="text">
                                <h1 style="text-align: center;  font-family:scribble;font-style: italic;"> &hearts; FOODIES LOVE &hearts;</h1> 
                                <p>Welcome to Recipes Love, where all foodies can connect with each other through recipes. There are so many recipes to choose from and helpful kitchen tips</p>
                                <p>Share some of your favourite recipes or get to see other people's recipes</p>
                            <div class="button-container">
                                <button type="button" class="button">Find Recipe</button>
                                <button type="button" class="button" onclick="location.href='addRecipeForm.php'">Add Recipe</button>
                            </div>
                        </div>
                    </div>
                    
                        <p id="benefits">The various recipes show the ingredients that you will need, the process, approximate cooking time as welll as how many servings it is suitable for. Not only do you get to see different kinds of recipes and but also get to interact with other in the comment section</p>
                    
                <h2 style="text-align: center; font-size:50px; color:red; font-style: oblique;">TOP RECIPES </h2>
                <div class="homeimages">
                    <div>
                        <img src="../Images/roasted potatoes.png" alt="Roasted Potatoes"/>
                        <a>Roasted Potatoes</a>
                        <p class="stars">&star;&star;&star;&star;&star;</p>
                    </div>
                    <div>
                        <img src="../Images/chicken puff.png" alt="Chicken Curry"/>
                        <a>Chicken Curry Pull</a>
                        <p class="stars">&star;&star;&star;&star;</p>
                    </div>
                    <div>
                        <img src="../Images/Lasagna.jpg" alt="Lasagna"/>
                        <a>Lasagna</a>
                        <p class="stars">&star;&star;&star;&star;&star;</p>
                    </div>
                    <div>
                        <img src="../Images/Nutella cake.jpg" alt="Nutella Cake"/>
                        <a>Nutella Cake</a>
                        <p class="stars">&star;&star;&star;&star;</p>
                    </div>
                    <div>
                        <img src="../Images/Mixed vegetables.jpg" alt="Mixed vegetables"/>
                        <a>Mixed vegetables</a>
                        <p class="stars">&star;&star;&star;&star;</p>
                    </div>
                </div>
                    <div class="testimonies">
                        <p id="para1">I have used this website for a while now and all I can say is that I feel like part of the communtity. The recipes shared here are amazing. I would definitely recommend you try some of the recipes. One of my favourite being the roasted potatoes.<span class="connect">~ Richard</span></p>
                        <p id="para2">True to the website's name this a place where foodies can connect. My friends introduced me to this website and since then I have never looked back<span class="connect">~ Hellen</span></p>
                        <p id="para3">I would definitely recommend you to use this website. There is not a single recipe that I couldn't find. I once cooked food for my friends and they said how it felt so homemade and good. They insisted that I have to share the recipe with them. <span class="connect">~ Anonymous</span></p>
                    </div>
                <div class="trial">
                    <img src="../Images/flour cook.jpg" alt="Cooking" style="height: 280px;"/>
                <div class="text" id="about-home">
                    <p style="font-family: cookie,cursive;font-style: italic;"> Hello, Lincy here</p>
                    <p>Welcome to Foodies Love</p>
                    <p>As a<strong style="color: red;">food lover</strong> and someone who enjoys cooking, I was very motivated to create a platfrom where other people just like me can share their favourite recipes as well as cooking tips.</p>
                    <a><u>More</u></a>
                </div>
                </div>
                </div>         
            </div>
        </main>
        <?php
        include "footer.php";?>
    </body>
</html>
        



    