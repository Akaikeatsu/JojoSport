<?php 
include_once("cabecera.php");
include_once("menu.php");
 ?>
<section>
	<?php
    $total = 0;
		if(isset($_SESSION["products"]) && count($_SESSION["products"])>0) { 
	?>
    <table class="table" id="shopping-cart-results">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
				
				foreach($_SESSION["products"] as $product){					
					$idproducto = $product["id"];
					$nombre = $product["nombre"]; 
					$precio = $product["precio"];
					$cantidad = $product["cantidad"];
					$subtotal = ($precio * $cantidad);
					$total = ($total + $subtotal);
			?>
			<tr>
                <td>
                    <?php echo $nombre;?>
                </td>
                <td>
                    <?php echo $precio; ?>
                </td>
                <td>
                	<?php echo $cantidad; ?>
                </td>
                <td>
                    <?php echo $subtotal; ?>
                </td>
            </tr>
		    <?php } ?>
    <?php 
		} else { 	
			echo "El carito esta vacio";	
		} 
	?>
		<tr>
			<td>
	        	Total:
	        	<?php echo $total; ?>
			</td>
        </tr>
        </tbody>
    </table>

</section>
<?php 
include_once("pie.html");
 ?>