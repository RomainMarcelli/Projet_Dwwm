$is_compatible = $sock['age'] == $_SESSION['age'] && $sock['couleur'] == $_SESSION['couleur'] && $sock['espece'] == $_SESSION['espece']; 



<?php if($is_compatible): ?>
            <p class="compatible">Compatible</p>
            <?php endif; ?>

            