<!DOCTYPE html>
<html>
    <head>
        <base href="/" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name=”robots” content="index, follow" />

        <link rel="icon" type="image/x-icon" href="favicon.ico" />

        <?php
            if (isset($this->assets['css']) && is_array($this->assets['css']))
                foreach ($this->assets['css'] as $css)
                    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$css."\">\n";

        ?>

        <title><?=$this->assets['title']?></title>
    </head>

    <body>
        <?php $this->appendView($data) ?>
        <?php
            if (isset($this->assets['js']) && is_array($this->assets['js']))
                foreach ($this->assets['js'] as $js)
                    echo "<script type=\"text/javascript\" src=\"".$js."\"></script>\n";
        ?>
    </body>
</html>
