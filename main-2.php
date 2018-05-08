
	<?php 
	include 'php/cabeza.php';
	include 'php/consultas.php';
      
    ?>
		<div class="container">	
			<header>
			<?php $r= nombre_empresa(); 
			echo "<img src='data:image/png;base64,".base64_encode($r['logo'])."' alt='Logo' class='img_txt'/ width='150px'> 
			";?>
				<!-- <img src="img/logo-.png" > -->
				<h1>
					MS CONSULTAS
					<span style="color: black; margin-bottom: -50px; font-weight: normal;">Sistema de Consultas ManguSoft</span>
				</h1>	
			</header>
			<div class="main clearfix" >
				<nav id="menu" class="nav" >					
					<ul >
					
						<li>
							<a href="consulta-participante.php">
								<span class="icon">
									<img src="img/report.svg" width="36px" aria-hidden="true">
									<!-- <i aria-hidden="true" class="icon-home"></i> -->
								</span>
								<span>Reportes</span>
							</a>
						</li>
						<!-- <li>
							<a href="#">
								<span class="icon">
									<img src="img/report.svg" width="36px" aria-hidden="true">
									
								</span>
								<span>Reportes</span>
							</a>
						</li> -->
						
						<li>
							<a href="graficos.php">
								<span class="icon">
									<img src="img/pie.svg" width="36px" aria-hidden="true">
									<!-- <i aria-hidden="true" class="icon-home"></i> -->
								</span>
								<span>Estad&iacute;sticas</span>
							</a>
						</li>
						<!-- <li><a href=""></a></li> -->
						<li>
						<?php if($_SESSION['crmRanking']!=3):?>
							<a href="importar-datos.php">
								<span class="icon"> 
									<!-- <i aria-hidden="true" class="icon-services"></i> -->
									<img src="img/import.svg" width="36px" aria-hidden="true" >
								</span>
								<span>Importar <br>Datos</span>
							</a>
						<?php endif ?>
						<?php if($_SESSION['crmRanking']==3):?>
							<a onclick='alert("Acceso no Permitido")'>
								<span class="icon"> 
									<!-- <i aria-hidden="true" class="icon-services"></i> -->
									<img src="img/import.svg" width="36px" aria-hidden="true" >
								</span>
								<span>Importar <br>Datos</span>
							</a>
						<?php endif ?>

						</li>
						<li>
							<a href="admin/main.php">
								<span class="icon"> 
									<!-- <i aria-hidden="true" class="icon-services"></i> -->
									<img src="img/settings2.svg" width="36px" aria-hidden="true" >
								</span>
								<span>Configuraci&oacute;n</span>
							</a>
						</li>
						<li>
							<a href="php/logout.php">
								<span class="icon"> 
									<!-- <i aria-hidden="true" class="icon-services"></i> -->
									<img src="img/logout.svg" width="36px" aria-hidden="true" >
								</span>
								<span>Salir</span>
							</a>
						</li>

						<li>
							<a href="http://mangusoft.com/crm_mangusoft2/Manual de Usuario 1.0.pdf" target="_blanc">
								<span class="icon"> 
									<!-- <i aria-hidden="true" class="icon-services"></i> -->
									<img src="img/icon.svg" width="36px" aria-hidden="true" >
								</span>
								<span>Acerca de</span>
							</a>
						</li>
						

						<!--<li>
							<a href="#">
								<span class="icon">
									<i aria-hidden="true" class="icon-portfolio"></i>
								</span>
								<span>Portfolio</span>
							</a>
						</li>
						 <li>
							<a href="#">
								<span class="icon">
									<i aria-hidden="true" class="icon-blog"></i>
								</span>
								<span>Blog</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>The team</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="icon">
									<i aria-hidden="true" class="icon-contact"></i>
								</span>
								<span>Contact</span>
							</a>
						</li> -->


					</ul>

				</nav>
				<br>
				<div ><p><a href="http://mangusoft.com/" style="text-decoration: none; font-weight: 400" target="_blanc" >ManguSoft ©</a> <?php echo date('Y');?> •TODOS LOS DERECHOS RESERVADOS. </p></div>
			</div>

		</div><!-- /container -->

		<script>
			//  The function to change the class
			var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};	

			//  Creating our button in JS for smaller screens
			var menuElements = document.getElementById('menu');
			menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

			//  Toggle the class on click to show / hide the menu
			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}

			// http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
			document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}
		</script>
<?php include 'php/pie.php'; ?>