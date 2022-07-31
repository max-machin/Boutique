<section class="delete-section comment-delete-section">
    <a href="admin" class="return"><i class="fa-solid fa-arrow-left"></i></a>
    <h2>Manage your comments</h2>
    <table>
        <thead>
            <tr>
                <th>Product name</th>
                <th>User name</th>
                <th class="commentPanelAdmin">Comment</th>
                <th>Note</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

       
    
    <?php
        foreach($findComments as $comment){    
            ?>
                <tr>
                    <td><?=$comment['name'] ?></td>
                    <td><?= $comment['prenom'] ?></td>
                    <td class="commentPanelAdmin"><?= $comment['comment'] ?></td>
                    <td><span class="NoteCommentPanelAdmin"><?= $comment['note']?> <i class="fa-solid fa-star"></i></span></td>
                    <td><?= $comment['date']?></td>
                    <td><form method="post">
                        <input type="hidden" value=<?= $comment['id'] ?> name="idComment">
                        <button type="submit" name="deleteComment">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form></td>
                </tr>
            <?php
            }
        
    ?>
        </tbody>
    </table>
</section>