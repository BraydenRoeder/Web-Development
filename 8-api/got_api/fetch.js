 document.getElementById("fetch_data").onclick = function(){
    fetch("https://thronesapi.com/api/v2/Characters")
        .then((response) => response.json())
        .then((data) => {
            data.forEach((charData) => {
                document.getElementById("display_data").innerHTML += charData['fullName'] + "<br>";
            })
        })
 }