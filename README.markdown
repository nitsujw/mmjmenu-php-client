## Setup
    require '/home/justin/apps/php/mmjmenu-php-client/Mmjmenu.php';
    $client = new Mmjmenu('API_KEY');
    
## Examples

### List Menu Items
    $menuItems      = $client->menuItems();
    $menuItems      = json_decode($menuItems, true);
    
    foreach($menuItems['menu_items'] as $item){
        print($item['name']);
    }

### Get a Menu Item
    $menuItem      = $client->menuItem('123')
    $menuItem      = json_decode($aitem, true);
    $menuItem      = $aitem['menu_item'];

    print($menuItem['name']);

