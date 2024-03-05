function conf_submit()
{
    if (document.getElementById('ujjelszo').value == "" || document.getElementById('ismetles').value == "")
    {
        alert("Adja meg a jelszót kétszer!");
        return false;
    }
    else {
        if (confirm("Biztosan meg szeretné változtatni a jelszót?") === false)
        {
            return false;
        }
        else {
            return true;
        }
    }
    
}