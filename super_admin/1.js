
    function formregistration() {

        let registrationform = document.querySelector(".student_verification");
        console.log(registrationform)
        let submit = document.querySelectorAll(".submit")
        console.log(submit)

        let html = ""
        registrationform.onsubmit = async (e) => {
                    e.preventDefault();

                    let response = await fetch("student_verification_handler.php", {
                        method: "POST",
                        body: new FormData(registrationform)
                    });

                    res = await response.text();
                    console.log(res)
                }
            }           
    