## Setup
    require '/home/justin/apps/php/mmjmenu-php-client/Mmjmenu.php';
    $client = new Mmjmenu('API_KEY');
    
## Examples

### List Menu Items
    $menuItems      = $client->menuItems();

### Get a Menu Item
    $menuItem      = $client->menuItem('123')

