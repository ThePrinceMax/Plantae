<!-- Sidebar
<section id="sidebar">
	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block sidebar" id="sidebar">
				<div class="sidebar-sticky">
					<br>
					<ul class="nav flex-column">
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 1</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 2</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 3</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 4</a>
						</li>

					</ul>
					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Paramètres du jeu</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 1</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 2</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 3</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 4</a>
						</li>

					</ul>
				</div>
			</nav>
		</div>
	</div>
</section>
-->

<!-- Main -->
<section id="main-content">
	<main role="main">
        <div class="container">
            <form class="form-signin" method="POST" action="./php/adduser.php">
                <h2 class="form-signin-heading">Sign Up</h2>
                <label for="login" class="sr-only">Adresse mail</label>
                <input type="email" id="login" name="login" class="form-control" placeholder="Email address" required autofocus>
                <label for="password" class="sr-only">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <label for="confirm" class="sr-only">Confirm - Mot de passe</label>
                <input type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirm" required>
                <br>
                <button class="btn btn-success btn-block" type="submit">Sign Up</button>
            </form>
        </div>
	</main>
</section>
