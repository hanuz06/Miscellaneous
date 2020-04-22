const fetch = require("node-fetch");

function hello() {
  fetch(
    "https://api-prod.linkin.bio/api/pub/linkinbio_posts?instagram_profile_id=32192"
  )
    .then((response) => {
      // console.log("response ", response.json());
      return response.json();
    })
    .then((data) => {
      let linkibio_post = data.linkinbio_posts[0];
      console.log(linkibio_post.caption);
    });
}
hello();
