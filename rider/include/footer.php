<div class="footer">
    <div class="container">


        <b class="copyright"> (2022 - 2023)
    </div>
</div>
<script>
    // Get the modal

    var popupModal = document.createElement("div");
    var modalContent = document.createElement("div");
    var iframe = document.createElement("iframe");
    var closeButton = document.createElement("span");

    modalContent.appendChild(closeButton);
    modalContent.appendChild(iframe);

    closeButton.setAttribute("class", "close");
    closeButton.innerHTML = "&times;";

    popupModal.setAttribute("id", "popupModal");
    popupModal.setAttribute("class", "modal");
    modalContent.setAttribute("class", "modal-content");

    popupModal.appendChild(modalContent);


    document.getElementsByTagName("BODY")[0].appendChild(popupModal);

</script>
<script language="javascript" type="text/javascript">

    var modal = document.getElementById("popupModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function () {
        modal.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    function popUpWindow(URLStr, left, top, width, height) {
        modal.style.display = "block";
        $('.modal iframe').attr('src', URLStr);
        event.preventDefault();
    }
</script>