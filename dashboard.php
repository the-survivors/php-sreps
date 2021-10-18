<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <title>People Health Pharmacy Inc.</title>
        
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <input type="checkbox" id="nav-toggle">
        
        <div class="sidebar">
            <div class="sidebar-brand">
                <h2><span class="las la-heartbeat"></span><span>PHP Inc.</span></h2>
            </div>
            
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="" class="active"><span class="las la-igloo"></span><span>Dashboard</span></a>
                    </li>
                    
                    <li>
                        <a href=""><span class="las la-receipt"></span><span>Sales</span></a>
                    </li>
                    
                    <li>
                        <a href=""><span class="las la-shopping-bag"></span><span>Stocks</span></a>
                    </li>
                    
                    <li>
                        <a href=""><span class="las la-clipboard-list"></span><span>Item Lists</span></a>
                    </li>
                    
                    <li>
                        <a href=""><span class="las la-arrow-circle-left"></span><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="main-content">
            <header>
                <h2>
                    <label for="nav-toggle">
                        <span class="las la-bars"></span>
                    </label>
                </h2>
                
                <div class="search-wrapper">
                    <span class="las la-search"></span>
                    <input type="search" placeholder="Search Here"/>
                </div>
                
                <div class="user-wrapper">
                    <img src="John.jpg" width="40px" height="40px" alt="">
                    
                    <div>
                        <h4>John</h4>
                        <small>Employee</small>
                    </div>
                </div>
            </header>
            
            <main>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1>100</h1>
                            <span>Sales</span>
                        </div>
                        
                        <div>
                            <span class="las la-receipt"></span>
                        </div>
                    </div>
                    
                    <div class="card-single">
                        <div>
                            <h1>100</h1>
                            <span>Item Lists</span>
                        </div>
                        
                        <div>
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    
                    <div class="card-single">
                        <div>
                            <h1>100</h1>
                            <span>Out of Stocks</span>
                        </div>
                        
                        <div>
                            <span class="las la-shopping-bag"></span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
</body>

</html>