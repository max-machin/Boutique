document.addEventListener('DOMContentLoaded', function loaded() {
    //pour le pop up à l'accueil
    var close = document.getElementById('close');
    
    
    console.log(window.innerWidth)

    if (window.innerWidth > 830){
        window.addEventListener('load', function(){
            // console.log('hey')
            setTimeout(
                function(){
                    document.querySelector('.pop-up').style.display = 'block';
                },
                900
            )
        });
            close.addEventListener("click", function(){
                document.querySelector('.pop-up').style.display = 'none';
            });
    }

        

        //INSTAFEED

const accessToken = "IGQVJXY0R5bkVEWXQwSmlSa1NMbzlzS2NFNjNOdHVCV3phUXlENnVfM0FDRFljZAzlJYWVRRHh2cE5wdGVqa2plV3FFWUYwWkFLVlhlbE80dW9WZAHJ0SEVyb2VZAbmtBNWRuY01zdVdhdjdJUXNCUHhiegZDZD";

const fields = "id,media_type,media_url,timestamp,permalink";

const accessUrl = `https://graph.instagram.com/me/media?fields=${fields}&access_token=${accessToken}`;

const section = document.getElementsByClassName("instafeed")
const instafeed = section[0];

const fetchPosts = async () => {

    try {

        const response = await fetch(accessUrl)
        const {data} = await response.json()

        data.forEach(post => {
            let a = document.createElement("a");
            a.href = post.permalink
            a.target = "_blank"
            a.rel = "noreferrer noopener"

            if(post.media_type === "VIDEO"){
                let video = document.createElement("video");
                video.src = post.media_url
                video.preload = true
                video.autoplay = true
                video.muted = true
                video.loop = true
                a.appendChild(video)
            } else {
                let img = document.createElement("img");
                img.src = post.media_url
                a.appendChild(img)
            }
            
            instafeed.appendChild(a)

        });

    } catch (error) {
        console.error(error);
    }
}

fetchPosts();
})