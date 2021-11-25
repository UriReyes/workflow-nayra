import { task } from '@/components/nodes';
import { getUsers, getForms } from "@/aworkflow/api";

window.ProcessMaker.EventBus.$on('modeler-init', async ({ registerInspectorExtension }) => {
  const { users } = await getUsers();
  const { forms } = await getForms();
  /* Add custom properties to inspector */
  registerInspectorExtension(task, {
    id: 'pm-due-in',
    component: 'FormInput',
    config: {
      type: 'number',
      label: 'Due In',
      placeholder: '72 hours',
      helper: 'Enter the hours until this Task is overdue',
      name: 'dueIn',
      validation: 'numeric|min:1',
    },
  });

  registerInspectorExtension(task, {
    id: 'pm-assigned-screen',
    component: 'FormSelect',
    config: {
      label: 'Screen / Form',
      placeholder: 'Select a form',
      helper: 'Assign screen / form to task',
      name: 'screenRef',
      options: forms,
    },
  });

  registerInspectorExtension(task, {
    component: 'FormAccordion',
    container: true,
    config: {
      initiallyOpen: false,
      label: 'Assignment Rules',
      icon: 'users',
      name: 'inspector-accordion',
    },
    items: [
      {
        id: 'pm-assigned-users',
        component: 'FormSelect',
        config: {
          label: 'Users',
          placeholder: 'Select a user',
          helper: 'Assign user to task',
          name: 'assignedUsers',
          options: users,
        },
      }
    ],
  });
});
