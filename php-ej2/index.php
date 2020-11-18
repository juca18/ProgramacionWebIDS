<html>
    <head>
        <title>Calculadora basica</title>
        <style type="text/css">

            fieldset{
                width: 15%;
                padding: 25px 25px 25px 25px;
                margin: auto;
            }
            .centerdiv{
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }

        </style>
    </head>
    <body>

        <fieldset>

             <form method='POST' action="app/test.php" class="centerdiv">

                <legend>
                    Calculadora basica
                </legend></br>

                <input type="text" name="value1" placeholder="Valor 1"> </br>
                <input type="text" name="value2" placeholder="Valor 2"> </br>

                <select name="option">
                    <option value="1">+</option>
                    <option value="2">-</option>
                    <option value="3">*</option>
                    <option value="4">/</option>
                </select>    </br>

                <button type="submit">Realizar operacion</button>

             </form>

        </fieldset>

    </body>
</html>