<header class="bg-dark text-white py-3 shadow">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            
            <h3 class="mb-0">SITS Club Event Dashboard</h3>
            
            <div class="ms-auto">
                <a href="logout.php" class="btn btn-outline-light btn-sm px-4" 
                onclick="return confirm('Are you sure you want to log out?');">
                    Logout
                </a>
            </div>
            
        </div>
    </div>
</header>

    <div class='container-fluid mt-3'>
       <form action='main_page.php' method='GET'>
        <div class='input-group'>
            <a href='add_event.php' class='btn btn-secondary flex-grow-1 flex-md-grow-0 px-4'>
                + Add New Event
            </a>
            
            <input type='text' name='search' class='form-control' placeholder='Search event name...'>
            
            <input type='date' name='date' class='form-control'>
            
            <button type='submit' class='btn btn-outline-dark px-4'>Filter</button>
        </div>
    </form>
</div>
<hr class='container-fluid mt-4'>