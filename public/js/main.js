function successToast(msg) 
{
    Toastify({
        gravity: "bottom",
        position: "center",
        text: msg,
        className: "mb-5",
        style: {
            background: "green"
        },
        // duration: 3000

    }).showToast();
}

function errorToast(msg) 
{
    Toastify({
        gravity: "bottom",
        position: "center",
        text: msg,
        className: "mb-5",
        style: {
            background: "red",
        },
        // duration: 3000

    }).showToast();
}