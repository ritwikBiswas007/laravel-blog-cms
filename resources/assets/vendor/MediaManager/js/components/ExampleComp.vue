<script>
import MediaModal from "../mixins/modal";

export default {
  name: "example-comp",
  mixins: [MediaModal],

  // the inputs we want to use the manager for
  // in our case they are the article 'cover' & 'gallery'
  // for multi-selected files 'links' "issues/40"
  //
  // for usage with an editor "wysiwyg" only, you dont need this part
  data() {
    return {
      cover: "",
      gallery: "",
      links: ""
    };
  }
};
</script>
