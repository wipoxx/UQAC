
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name='description' content="<?php echo $this->getDescription() ?>">
        <html lang="fr">
        <link rel="stylesheet" type="text/css" href="media/style/style.css" />
            
        <?php 
        if ($this->getStyle() != null) {
            echo '<link rel="stylesheet" type="text/css" href="media/style/'.$this->getStyle().'"/>';
        }
        ?>
            <title><?php echo $this->getTitre() ?></title>
        </head>
        <body>