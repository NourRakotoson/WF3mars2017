		
		<div class="modal fade" id="myModal" role="dialog"> 
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					  <h4 class="modal-title">Le produit a bien été ajouté au panier </h4>
					</div>
					
					<div class="modal-body">
						<p><a href="panier.php">Voir le panier</a></p>
						<p><a href="boutique.php">Continuer ses achats</a></p>
					</div>
					
				</div>	
			</div>
	   </div>
		
		
		
		
		

		<div class="row">
			
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><?=  $produit['titre']  ?></h1>
				</div>
			 </div>
	
	
			<div class="col-md-8">
				<img class="img-responsive" src="<?=  $produit['photo']  ?>" alt="">
			 </div>
	
			<div class="col-md-4">
				<h3>Description</h3>
				<p><?=  $produit['description']  ?></p>
				
				<h3>Détails</h3>
				<ul>
					<li>Catégorie : <?=  $produit['categorie']  ?></li>
					<li>Couleur : <?=  $produit['couleur']  ?></li>
					<li>Taille : <?=  $produit['taille']  ?></li>
				</ul>
				
				<p class="lead">Prix : <?=  $produit['prix']  ?> €</p>
				
			</div>
			

			<div class="col-md-4">
				<?php if ($produit['stock'] > 0) : ?>

					<form method="post" action="panier.php">
						<input type="hidden" name="id_produit" value="<?=  $produit['id_produit']  ?>">
						
						<select name="quantite" id="quantite" class="form-group-sm form-control-static">
							for ($i = 1; $i <= $produit['stock'] && $i <= 5; $i++) {
								<option>$i</option>
							}	
						</select>
					
						<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn" style="margin-left:10px">
					
					</form>
				<?php  else : ?>
					<p>Rupture de stock</p>
				<?php endif; ?>
			

				<br><p><a href="boutique.php?categorie=<?=  $produit['categorie']  ?>">Retour vers votre sélection</a></p>
			
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Suggestions de produits</h3>
			</div>
			
			<div class="col-sm-3">
				<a href="fiche_produit.php?id_produit=<?=  $affichage['id_produit']  ?>"><img src="<?=  $affichage['photo']  ?>" style="width:100%"></a>
				<h4><?=  $affichage['titre']  ?></h4>
			</div>
			
		</div>

		<script>
			$(document).ready(function(){
				// affiche la fenêtre modale :
				$("#myModal").modal("show");
			});
		</script>