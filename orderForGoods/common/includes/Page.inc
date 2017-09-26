<?php
class Page
{
    public $content; // 页面的主要内容，也就是HTML标签和文本的组合
    public $title = 'TLA Consulting Pty Ltd'; // 页面标题
    public $keywords = 'TLA Consulting, Three Letter Abbreviation, // 方便浏览器检索
    some of my best friends are search engines'; // 菜单标签
    // 导航条
    public $buttons = array('Home' => 'home.php',
        'Contact' => 'contact.php',
        'Services' => 'services.php',
        'Site Map' => 'map.php');

    // 可以设置上面的变量值
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    // 显示函数
    public function Display()
    {
        echo "<html>\n<head>\n";
        $this->DisplayTitle();
        $this->DisplayKeywords();
        $this->DisplayStyles();
        echo "</head>\n<body>\n";
        $this->DisplayHeader();
        $this->DisplayMenu($this->buttons);
        echo $this->content;
        $this->DisplayFooter();
        echo "</body>\n</html>\n";
    }
    public function DisplayTitle()
    {
        echo '<title>'.$this->title.'</title>';
    }
    public function DisplayKeywords()
    {
        echo '<meta name="keywords" content="'.$this->keywords.'"/>';
    }
    public function DisplayStyles()
    {
        ?>
        <style>
            h1 {
                color: white;
                font-size: 24pt;
                text-align: center;
                font-family: arial, sans-serif;
            }
            .menu {
                color: white;
                font-size: 12pt;
                text-align: center;
                font-family: arial, sans-serif;
                font-weight: bold;
            }
            .menu.active {
                color: yellow;
            }
            td {
                background: black;
            }
            p {
                color: black;
                font-size: 12pt;
                text-align: justify;
                font-family: arial, sans-serif;
            }
            p.foot {
                color: black;
                font-size: 9pt;
                text-align: center;
                font-family: arial, sans-serif;
                font-weight: bold;
            }
            a:link, a:visited, a:active {
                color: white;
            }
        </style>
        <?php
    }

    public function DisplayHeader()
    {
        ?>
        <table width="100%" cellpadding="12" cellspacing="0" border="0">
            <tr bgcolor="black">
                <td>
                    <h1>TLA Consulting Pty Ltd</h1>
                </td>
            </tr>
        </table>
        <?php
    }
    public function DisplayMenu($buttons)
    {
        echo "<table width='100%' bgcolor='white' cellpadding='4' cellspacing='4'>\n";
        echo "<tr>\n";
        $width = 100/count($buttons);
        while(list($name, $url) = each($buttons)) {
            $this->DisplayButton($width, $name, $url, !$this->IsURLCurrentPage($url));
        }
        echo "</tr>\n";
        echo "</table>\n";
    }

    public function IsURLCurrentPage($url) {
        // $_SERVER['PHP_SELF'] 引用当前网页地址
        //echo $_SERVER['PHP_SELF']."<br/>";
        if(strpos($_SERVER['PHP_SELF'], $url) == false) {
            return false;
        } else {
            return true;
        }
    }

    public function DisplayButton($width, $name, $url, $active = true) {
        if($active) {
            echo "<td width='".$width."%'>
            <a href='".$url."'><span class='menu active'>".$name."</span></a>
            </td>";
        } else {
            echo "<td width='".$width."%'>
            <a href='".$url."'><span class='menu'>".$name."</span></a>
            </td>";
        }
    }

    public function DisplayFooter() {
        ?>
        <table width="100%" bgcolor="black" cellpadding="12" border="0">
            <tr>
                <td>
                    <p class="foot">&copy; TLA Consulting Pty Ltd.</p>
                    <p class="foot">Please see our <a href="">legal information page</a></p>
                </td>
            </tr>
        </table>
        <?php
    }

}


















