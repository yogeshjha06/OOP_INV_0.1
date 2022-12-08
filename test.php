<form method='POST' onsubmit="return validate();">
<script>
    function tst(){
       // alert("Test");
        document.getElementById('name').readOnly = false;
        document.getElementById("name").style.color = "blue";
        document.getElementById("name").style.backgroundColor = "lightgrey";
        document.getElementById("btn").className="btnvstl";
    }
    function txtchange(){
        document.getElementById("name1").value=document.getElementById("name").value;
    }
   
</script>
<style>
    .btnstl{
        visibility: hidden;
        width: 100%;
    }
    .btnvstl{
        visibility: visible;
        width: 100%;
    }
</style>
    <table id='customers'>
        <tr>
            <td>Item Name</td>
            <td><input type='text' id="name1" style="border-style: none;"
             readonly autocomplete="off"
              placeholder='Item Name' name='item'/></td>
            <td><input type='text' id="name" style="border-style: none;"
             readonly ondblclick="tst()" autocomplete="off"
              placeholder='Item Name' name='item' required oninput="txtchange()"/></td>
        </tr>
        <tr>
            <td colspan='2'><button id="btn" class="btnstl" type='submit' name='ok'>ADD</button></td>
        </tr>
    </table>
</form>