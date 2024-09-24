<template>
    <div class="task-item">
      <div v-if="!todo.isEditing">
        <div>
          <input
            type="checkbox"
            v-model="todo.completed"
            @change="updateTodo(todo)"
            class="form-check-input me-2"
          />
          <span :class="{ 'fw-bold': todo.completed }">
            {{ todo.title }} (Due: {{ todo.due_date || 'No date' }})
          </span>
        </div>
      </div>
  
      <!-- Input untuk mengedit judul dan tanggal -->
      <div v-if="todo.isEditing" class="row">
        <div class="col">
          <input class="form-control" v-model="todo.title" @keyup.enter="saveTodo(todo)" placeholder="Edit title" />
        </div>
        <div class="col">
          
        <input class="form-control" type="date" v-model="todo.due_date" @change="saveTodo(todo)" />
        </div>
      </div>
  
      <div class="btn-group btn-group-sm mt-1 mb-2 " role="group" aria-label="Basic mixed styles example">
        <button v-if="!todo.isEditing" @click="editTodo" type="button" class="btn btn-outline-primary ">Edit</button>
        <button v-else type="button" class="btn btn-outline-primary" @click="cancelTodo">Cancel</button>
        <button v-if="todo.isEditing" @click="saveTodo(todo)" type="button" class="btn btn-outline-primary">Save</button>
        <button @click="deleteTodo(todo.id)" type="button" class="btn btn-outline-primary">Delete</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      todo: Object
    },
    methods: {
      editTodo() {
        this.$emit('edit', this.todo);
      },
      cancelTodo() {
        this.$emit('cancel', this.todo);
      },
      saveTodo(todo) {
        this.$emit('update', todo);
      },
      updateTodo(todo) {
        this.$emit('update', todo);
      },
      deleteTodo(id) {
        this.$emit('delete', id);
      }
    }
  };
  </script>
  
  <style scoped>
  .completed {
    text-decoration: line-through;
  }
  </style>
  