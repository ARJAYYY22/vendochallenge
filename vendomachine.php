<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        fieldset {
            border: none;
            padding: 10px 0;
            margin-bottom: 15px;
        }
        legend {
            font-size: 18px;
            color: #444;
            font-weight: bold;
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin: 5px 0;
            font-size: 15px;
            color: #555;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        select, input[type="number"] {
            width: calc(100% - 22px);
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
        }
        select:hover, input[type="number"]:hover {
            border-color: #28a745;
        }
        button {
            display: block;
            width: 100%;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vendo Machine</h2>
        <form action="" method="post">
            <fieldset>
                <legend>Drinks</legend>
                <input type="checkbox" name="Drinks[]" id="Coke" value='{"name": "Coke", "price": 15}'>
                <label for="Coke">Coke - ₱15</label>

                <input type="checkbox" name="Drinks[]" id="Sprite" value='{"name": "Sprite", "price": 20}'>
                <label for="Sprite">Sprite - ₱20</label>

                <input type="checkbox" name="Drinks[]" id="Royal" value='{"name": "Royal", "price": 20}'>
                <label for="Royal">Royal - ₱20</label>

                <input type="checkbox" name="Drinks[]" id="Pepsi" value='{"name": "Pepsi", "price": 15}'>
                <label for="Pepsi">Pepsi - ₱15</label>

                <input type="checkbox" name="Drinks[]" id="Mountain" value='{"name": "Mountain Dew", "price": 20}'>
                <label for="Mountain">Mountain Dew - ₱20</label>
            </fieldset>
            <fieldset>
                <legend>Options</legend>
                <label for="size">Size:</label>
                <select name="size" id="size">
                    <option value="Regular">Regular</option>
                    <option value="Up-Size">Up-Size (add ₱5)</option>
                    <option value="Jumbo">Jumbo (add ₱10)</option>
                </select>

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required>
            </fieldset>
            <button type="submit">Submit</button>
            <button type="submit" name="btnSend">Check Out</button>
        </fieldset>
    </form>
    <?php
    /*if(isset($_REQUEST['btnSend'])){

        $drinks = $_REQUEST['Drinks'] ?? [];
        $size = $_REQUEST['size'] ?? 'Regular';
        $quantity = intval($_REQUEST['quantity']) ?? 1;
        $totalAmount = 0;
        $totalItems = 0;
        $totalCost = 0; 

        echo "<h4>Purchase Summary:</h4>";

        if ($size === "Up-Size") {
            $totalCost += 5;
        } elseif ($size === "Jumbo") {
            $totalCost += 10;
        }

        if (empty($drinks)) {
            echo "No drinks selected. Please choose at least one drink.<br>";
        } else {
            foreach ($drinks as $drink) {
                list($drinksName, $price) = explode('-', $drink);
                $price = intval($price);
                $itemTotal = ($price + $totalCost) * $quantity;
                $totalAmount += $itemTotal;
                $totalItems += $quantity;
                if($quantity==1){
                
                echo'<ul>';
                echo"<li>$quantity piece of $size $drinksName amounting to ₱$itemTotal</li>";
                echo'</ul>';
                }else{

                echo'<ul>';
                echo"<li>$quantity pieces of $size $drinksName amounting to ₱$itemTotal</li>";
                echo'</ul>';
                }
            }
            echo "<br><b>Total Number of Items:</b> {$totalItems}<br>";
            echo "<b>Total Amount:</b> ₱{$totalAmount}<br>";
        }
    }*/
    if (isset($_REQUEST['btnSend'])) {
        $arrDrinks = $_REQUEST['Drinks'] ?? [];
        $size = $_REQUEST['size'] ?? 'Regular';
        $quantity = intval($_REQUEST['quantity']) ?? 1;
        $totalAmount = 0;
        $totalItems = 0;
        $totalCost = 0;
        $purchaseSummary = []; 
        
        if ($size === "Up-Size") {
            $totalCost = 5;
        } elseif ($size === "Jumbo") {
            $totalCost = 10;
        }

    
        echo "<h4>Purchase Summary:</h4>";
    
        if (empty($arrDrinks)) {
            echo "No drinks selected. Please choose at least one drink.<br>";
        } else {
            foreach ($arrDrinks as $drink) {
                $drinkData = json_decode($drink, true);
               
                $drinkName = $drinkData['name'] ?? 'Unknown Drink';
                $price = intval($drinkData['price'] ?? 0); 
                $itemTotal = ($price+$totalCost) * $quantity; 
              
                $totalAmount += $itemTotal;
                $totalItems += $quantity; 
    
                if ($quantity == 1) {
                    $purchaseSummary[] = "$quantity piece of $size $drinkName amounting to ₱$itemTotal";
                } else {
                    $purchaseSummary[] = "$quantity pieces of $size $drinkName amounting to ₱$itemTotal";
                }
            }
            foreach ($purchaseSummary as $item) {
              
                echo"<ul><li>$item</li></ul>";
            }
            echo "<br><b>Total Number of Items:</b> {$totalItems}<br>";
            echo "<b>Total Amount:</b> ₱{$totalAmount}<br>";
        }
    }
    ?>

        </form>
    </div>
</body>
</html>
