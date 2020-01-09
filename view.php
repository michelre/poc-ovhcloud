<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POC OVH Cloud</title>
</head>
<body>

    <form enctype="multipart/form-data" method="post" action="?action=send-file">
        <div>
            <input type="file" name="document">
        </div>
        <button type="submit">Envoyer</button>
    </form>

    <h1>Existing files</h1>
    <table>
        <thead>
            <tr>
                <th>File name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file) { ?>
                <tr>
                    <td><?= $file ?></td>
                    <td>
                        <a href="?action=download-file&name=<?= $file ?>">Télécharger</a>
                        <a href="?action=delete-file&name=<?= $file ?>">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
