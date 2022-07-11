document.addEventListener('DOMContentLoaded', function loaded() {
    console.log("IM here")
    //pour le pop up à l'accueil
    var close = document.getElementById('close');

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

        

        //INSTAFEED

const accessToken = "IGQVJXZAzljNlV0OHVUNDRUZAkNaZA28tRE5Nc09WMGp2Q3V3ekRTRjV2empnZA1kwSDc0UUE1WWlMbnppYnF0elFRNWFSZAFVyeFZAiWkgxZAnNEdEFSM3VwWlA3VFdoQkNOc2hrVXFZAMnBlTW9Dci1ZARlhXTQZDZD";

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