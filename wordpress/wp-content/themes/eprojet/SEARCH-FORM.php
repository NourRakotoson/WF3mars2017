<form method="get" action="<?php trailinglashit(home_url());?>" class="navbar-form">
    <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e('Saisir le nom d\'un restaurant ou d\'une ville', 'eprojet') ?>" >
    <input type="submit" class="submit" name="submit" id="submit-search" value="<?php esc_attr_e('GO', 'eprojet') ?>" >

</form>