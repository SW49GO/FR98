<a href='#' onclick='loadHtml("containerHtml","InfoGuerre.html")'>
    Fichier html
</a>

<script>
    function loadHtml(id, filename) {
        console.log(`div id:${id},filename:${filename}`);
        let xttp;
        let element = document.getElementById(id);
        let file = filename;
        if (file) {
            xttp = new XMLHttpRequest();
            xttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) { element.innerHTML = this.responseText; }
                    if (this.status == 404) { element.innerHTML = "<h1>Page non trouvé</h1>"; }
                }
            }
            xttp.open("GET", `../public/excel/${file}`, true);
            xttp.send();
            return;
        }
    }
</script>