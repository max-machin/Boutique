<section class="delete-section user-delete-section">
    <a href="admin" class="return"><i class="fa-solid fa-arrow-left"></i></a>
    <h2>Manage your users</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th class="hiddenManageUser">First name</th>
                <th class="hiddenManageUser">Last name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

       
    
    <?php
        foreach($findUsers as $user){
             
            if ($user['id'] != 1){
                ?>
                    <tr>
                        <td><?=$user['email'] ?></td>
                        <td class="hiddenManageUser"><?= $user['prenom'] ?></td>
                        <td class="hiddenManageUser"><?= $user['nom'] ?></td>
                        <td>
                            <form method="post" class="deleteButtonManage">
                                <input type="hidden" value=<?= $user['id'] ?> name="idUser">
                                <button type="submit" name="deleteUser">
                                <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
            }
        }
    ?>
        </tbody>
    </table>
</section>