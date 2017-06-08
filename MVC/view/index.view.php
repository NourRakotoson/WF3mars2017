
    <h1>Utilisateurs</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Adresse</th>
        </tr>
        <?php
        foreach ($users as $user) : 
        ?>
        <tr>
            <th><?= $user->getID() ?></th>
            <th><?= $user->getLastName() ?></th>
            <th><?= $user->getFirstName() ?></th>
            <th><?= $user->getEmail() ?></th>
            <th><?= $user->getAdress() ?></th>
        </tr>
        <?php
        endforeach;
        ?>
    </table>
 

