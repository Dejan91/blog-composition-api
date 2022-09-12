<template>
  <EditorContent :editor="editor"/>
</template>

<script>
import { EditorContent, useEditor } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import { watch } from "vue"


export default {
  components: { EditorContent },
  props: {
    modelValue: {
      type: String,
      default: ''
    },
    teaserValue: {
      type: String,
      default: ''
    }
  },
  setup(props, { emit }) {
    const editor = useEditor({
      content: props.modelValue,
      extensions: [
        StarterKit
      ],
      editorProps: {
        attributes: {
          class: 'min-w-full w-full text-gray-500 prose prose-sm lg:prose focus:outline-none'
        }
      },
      onUpdate: (context) => {
        const teaser = context.editor.state.doc.content.content.find(
            content => content.type.name === 'paragraph'
        )

        emit('update:teaserValue', teaser.textContent)
        emit('update:modelValue', context.editor.getHTML())
      }
    })

    watch(() => props.modelValue, (value) => {
      if (editor.value.getHTML() === value) {
        return
      }

      editor.value.commands.setContent(value)
    })

    return {
      editor
    }
  }
}
</script>