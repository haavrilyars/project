<div id="pleft">
    <table>
        <tr>
            <th>Item name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $cart = $this->cart->contents();
        foreach ($cart as $item): ?>
        <tr>
            <td>
                <?php echo $item['name']; ?>
            </td>
            <td>
                <?php echo $item['price'];?>
            </td>
            <td>
                <?php echo $item['qty'];?>
            </td>
            <td>
                <?php echo $item['subtotal'];?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>