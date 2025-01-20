document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab-button");
  const groups = document.querySelectorAll(".field-group");
  initScripts(tabs, groups);
});

function initScripts(tabs, groups) {
  tabs[0].classList.add("active");
  groups[0].classList.add("active");

  for (let index = 0; index < tabs.length; index++) {
    const tab = tabs[index];

    tab.addEventListener("click", (e) => {
      e.preventDefault();
      const group = groups[index];
      showGroup(e, index, group);
    });
  }
}

function showGroup(e, index, group) {
  document.querySelectorAll(".field-groups .active").forEach((item) => {
    item.classList.remove("active");
  });
  e.currentTarget.classList.add("active");
  group.classList.add("active");
}

jQuery(document).ready(function ($) {
  // Uploading files
  var file_frame;
  var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
  var set_to_post_id = $("#default_cover_image").val(); // Set this

  jQuery("#upload_image_button, .image-preview-wrapper").on(
    "click",
    function (event) {
      event.preventDefault();

      // If the media frame already exists, reopen it.
      if (file_frame) {
        // Set the post ID to what we want
        file_frame.uploader.uploader.param("post_id", set_to_post_id);
        // Open frame
        file_frame.open();
        return;
      } else {
        // Set the wp.media post id so the uploader grabs the ID we want when initialised
        wp.media.model.settings.post.id = set_to_post_id;
      }

      // Create the media frame.
      file_frame = wp.media.frames.file_frame = wp.media({
        title: "Selecciona una imagen",
        button: {
          text: "Usar esta imagen",
        },
        multiple: false, // Set to true to allow multiple files to be selected
      });

      // When an image is selected, run a callback.
      file_frame.on("select", function () {
        // We set multiple to false so only get one image from the uploader
        attachment = file_frame.state().get("selection").first().toJSON();

        // Do something with attachment.id and/or attachment.url here
        $("#default_cover_image").val(attachment.id);
        $("#image-preview").attr("src", attachment.url).css("display", "block");

        // Restore the main post ID
        wp.media.model.settings.post.id = wp_media_post_id;
      });

      // Finally, open the modal
      file_frame.open();
    }
  );

  // Restore the main ID when the add media button is pressed
  jQuery("a.add_media").on("click", function () {
    wp.media.model.settings.post.id = wp_media_post_id;
  });

  jQuery(".remove").on("click", function (event) {
    event.preventDefault();
    event.stopPropagation();

    $("#default_cover_image").removeAttr("value");
    $("#image-preview").removeAttr("src");
    $("#image-preview, .remove").css("display", "none");
  });
});
