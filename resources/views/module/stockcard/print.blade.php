<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #section-to-print, #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>

    $("#printableArea").submit();
    function printDiv() {
        var divName = 'printableArea';
        var printContents = document.getElementById(divName).innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        return true;
    }
</script>

<div id="printableArea">
    <?php
    $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
    echo $generator->getBarcode($value, $generator::TYPE_CODE_128, 1);
    ?>
</div>

<button  id="printableArea" onclick="printDiv()">YAZDIR</button>

