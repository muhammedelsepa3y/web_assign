<?php include('Header.php'); ?>

<main>
    <h2>Registration Form</h2>
    <form id="registrationForm" action="Upload.php" method="post" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br>

        <label for="user_name">Username:</label>
        <input type="text" id="user_name" name="user_name" required><br>

        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" required><br>
        <button type="button" id="checkActors">Check Actors</button><br>
        <p>Actors born on this date:</p>

        <ul id="checkActors"></ul>


        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <label for="user_image">User Image:</label>
        <input type="file" id="user_image" name="user_image" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <input type="submit" value="Register">
    </form>
</main>

<script src="clientValidation.js"></script>
<script>
    document.getElementById('checkActors').addEventListener('click', function() {
        var birthdate = new Date(document.getElementById('birthdate').value);
        var month = birthdate.getMonth() + 1; // JavaScript months are 0-based
        var day = birthdate.getDate();

        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === this.DONE) {
                console.log('API response:', this.responseText);
                var actors = JSON.parse(this.responseText);
                var actorList = document.getElementById('actorList');
                if (actorList) {
                    actorList.innerHTML = '';
                    actors.forEach(function(actor) {
                        var li = document.createElement('li');
                        li.textContent = actor.name;
                        actorList.appendChild(li);
                    });
                } else {
                    console.log('actorList element not found');
                }
            }
        });

        var url = 'https://imdb-com.p.rapidapi.com/actors/list-born-today?month=' + month + '&day=' + day;
        console.log('API request URL:', url);
        xhr.open('GET', url);
        xhr.setRequestHeader('X-RapidAPI-Key', '85cb10e373msh2d88a62505bcd12p163994jsn914d10a793b2');
        xhr.setRequestHeader('X-RapidAPI-Host', 'imdb-com.p.rapidapi.com');

        xhr.send(null);
    });
</script>
<?php include('Footer.php'); ?>
