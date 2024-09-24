<template>
    <div>
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title text-center my-3">Lets do something!</h5>
          <form @submit.prevent="addTodo">
            <div class="mb-3">
              <input
                v-model="newTodo.title"
                type="text"
                class="form-control"
                placeholder="Enter task title"
                required
              />
            </div>
            <div class="mb-3">
              <input
                v-model="newTodo.due_date"
                type="date"
                class="form-control"
              />
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-md">Add Task</button>
          </form>
        </div>
      </div>

      <div class="accordion mb-4" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Before
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.before.length">
          <li v-for="todo in groupedTodos.before" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo"  @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              Today
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.today.length">
          <li v-for="todo in groupedTodos.today" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo"  @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Tomorrow
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.tomorrow.length">
          <li v-for="todo in groupedTodos.tomorrow" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo"  @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              This Week
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.thisWeek.length">
          <li v-for="todo in groupedTodos.thisWeek" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo"  @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              Next Week
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.nextWeek.length">
          <li v-for="todo in groupedTodos.nextWeek" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo"  @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
              Next
            </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.next.length">
          <li v-for="todo in groupedTodos.next" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo"  @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
              No Due Date
            </button>
          </h2>
          <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul v-if="groupedTodos.noDate.length">
          <li v-for="todo in groupedTodos.noDate" :key="todo.id">
            <task-item :todo="todo" @edit="editTodo" @delete="deleteTodo" @update="saveTodo" @cancel="cancelEdit"></task-item>
          </li>
        </ul>
        <p v-else>No tasks.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
  import axios from 'axios';
  import TaskItem from './TaskItem.vue';
  import moment from 'moment';

  export default {
    components: {
      TaskItem
    },
    data() {
      return {
        todos: [],
        newTodo: {
          title: '',
          due_date: ''
        }
      };
    },
    created() {
      this.fetchTodos();
    },
    computed: {
      groupedTodos() {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);
        const todays = moment().startOf('day');

  
        const thisWeekStart = new Date(today.setDate(today.getDate() - today.getDay()));
        const thisWeekEnd = new Date(today.setDate(today.getDate() + 6 - today.getDay()));
  
        const nextWeekStart = new Date(thisWeekEnd);
        nextWeekStart.setDate(nextWeekStart.getDate() + 1);
  
        const nextWeekEnd = new Date(nextWeekStart);
        nextWeekEnd.setDate(nextWeekEnd.getDate() + 6);
  
        return {
          today: this.todos.filter(todo => this.isSameDay(new Date(todo.due_date), new Date())),
          tomorrow: this.todos.filter(todo => this.isSameDay(new Date(todo.due_date), tomorrow)),
          thisWeek: this.todos.filter(todo => new Date(todo.due_date) > today && new Date(todo.due_date) <= thisWeekEnd),
          nextWeek: this.todos.filter(todo => new Date(todo.due_date) > thisWeekEnd && new Date(todo.due_date) <= nextWeekEnd),
          noDate: this.todos.filter(todo => !todo.due_date),
          before: this.todos.filter(todo => moment(todo.due_date).isBefore(todays)),
          next: this.todos.filter(todo => new Date(todo.due_date) > nextWeekEnd)
        };
      }
    },
    methods: {
      async fetchTodos() {
        const response = await axios.get('/api/todos');
        this.todos = response.data;
      },
      async addTodo() {
        if (this.newTodo.title.trim()) {
          const response = await axios.post('/api/todos', this.newTodo);
          this.todos.push(response.data);
          this.newTodo = { title: '', due_date: '' };
        }
      },
      async saveTodo(todo) {
        await axios.put(`/api/todos/${todo.id}`, { title: todo.title, due_date: todo.due_date });
        todo.isEditing = false;
      },
      editTodo(todo) {
        todo.isEditing = true;
      },
      cancelEdit() {
        this.fetchTodos();
        todo.isEditing = false;
      },
      async deleteTodo(id) {
        await axios.delete(`/api/todos/${id}`);
        this.todos = this.todos.filter(todo => todo.id !== id);
      },
      isSameDay(date1, date2) {
        return date1.toDateString() === date2.toDateString();
      }
    }
  };
  </script>
  
  <style scoped>
  .completed {
    text-decoration: line-through;
  }
  </style>
  