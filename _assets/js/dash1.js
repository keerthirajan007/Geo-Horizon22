var currentTab = "event-list";
var curr_form_obj = -100;

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
});

var data = {
  contacts: [],
  eventList: [],
  transactions: [],
  users: [],
  events: {},
};

var mainLoader = document.getElementById("main-loader");
var warningModal = {
  container: document.getElementById("warning-modal"),
  content: document.getElementById("warning-modal-content"),
};
warningModal.switch = $(warningModal.container);

var normalModal = {
  container: document.getElementById("normal-modal"),
  content: document.getElementById("normal-modal-content"),
  title: document.getElementById("normal-modal-title"),
  save: document.getElementById("normal-modal-save"),
  register: document.getElementById("normal-modal-register"),
  saveAlert: document.getElementById("normal-modal-save-alert"),
};
normalModal.switch = $(normalModal.container);

var composeWindow = {
  container: document.getElementById("candidate-mail"),
  title: document.getElementById("candidate-mail-title"),
  user: document.getElementById("candidate-mail-user"),
  user1: document.getElementById("candidate-mail-user1"),
  subject: document.getElementById("candidate-mail-subject"),
  content: document.getElementById("candidate-mail-content"),
  send: document.getElementById("candidate-mail-send"),
  userContainer: document.getElementById("candidate-mail-user-container"),
  user1Container: document.getElementById("candidate-mail-user1-container"),
  selectUser: undefined,
  selectUser1: undefined,
};

composeWindow.selectUser = $(composeWindow.user);
composeWindow.selectUser1 = $(composeWindow.user1);
composeWindow.selectUser.select2({ data: [] });
composeWindow.selectUser1.select2({ data: [] });

mainLoader.onclick = (e) => {
  e.stopPropagation();
  e.preventDefault();
};

var navbarDom = {
  container: document.getElementById("header"),
  menu: document.getElementById("menu-button"),
  refreshIcon: document.getElementById("refresh-icon"),
};

var sidebarDom = {
  eventListContainer: document.getElementById("event-list-sidebar"),
};

var contentDom = {
  container: document.getElementById("content"),
  lastCheck: document.getElementById("last-refreshed"),
  header: {
    title: document.getElementById("content-title"),
    left: document.getElementById("content-header-left"),
    right: document.getElementById("content-header-right"),
  },
};

var contactDom = {
  container: document.getElementById("contact-container"),
  containerLeft: document.getElementById("contact-container-left"),
  containerRight: document.getElementById("contact-container-right"),
};

var eventListDom = {
  container: document.getElementById("event-list-container"),
  containerLeft: document.getElementById("event-list-container-left"),
  containerMid: document.getElementById("event-list-container-mid"),
  containerRight: document.getElementById("event-list-container-right"),
};

var eventDom = {
  container: document.getElementById("event-container"),
  candidateTable: document.getElementById("candidate-list-table"),
  candidateMsgDropdown: document.getElementById("candidate-message-dropdown"),
  candidateMsgAll: document.getElementById("candidate-message-all"),
  candidateMsgSpecific: document.getElementById("candidate-message-specific"),
  candidateTableBody: document.getElementById("candidate-list-table-body"),
  metaData: document.getElementById("event-metadata"),
  metaDataTitle: document.getElementById("event-metadata-title"),
  metaDataBody: document.getElementById("event-metadata-body"),
};

eventDom.dataTable = $(eventDom.candidateTable).DataTable({
  lengthChange: false,
  autoWidth: true,
  scrollX: true,
  select: true,
  scrollCollapse: true,
  buttons: [
    "copy",
    "csv",
    "excel",
    {
      extend: "pdfHtml5",
      orientation: "landscape",
      pageSize: "A3",
      title: () =>
        eventDom.metaDataTitle.textContent +
        "_c_" +
        new Date().toLocaleString(),
    },
    "print",
    "colvis",
  ],
  fixedColumns: {
    left: 1,
  },
});

eventDom.dataTable
  .buttons()
  .container()
  .appendTo("#candidate-list-table_wrapper .col-md-6:eq(0)");

var transactDom = {
  container: document.getElementById("transactions-container"),
  transactionsTable: document.getElementById("transactions-table"),
  transactionsTableBody: document.getElementById("transactions-table-body"),
};
transactDom.dataTable = $(transactDom.transactionsTable).DataTable({
  lengthChange: false,
  autoWidth: true,
  scrollX: true,
  select: true,
  scrollCollapse: true,
  buttons: [
    "copy",
    "csv",
    "excel",
    {
      extend: "pdfHtml5",
      orientation: "landscape",
      pageSize: "A3",
      title: () => "Transactions_" + new Date().toLocaleString(),
    },
    "print",
    "colvis",
  ],
  fixedColumns: {
    left: 1,
  },
});

transactDom.dataTable
  .buttons()
  .container()
  .appendTo("#transactions-table_wrapper .col-md-6:eq(0)");

var userDom = {
  container: document.getElementById("users-container"),
  usersTable: document.getElementById("users-table"),
  usersTableBody: document.getElementById("users-table-body"),
  userMsgDropdown: document.getElementById("user-message-dropdown"),
  userMsgAll: document.getElementById("user-message-all"),
  userMsgSpecific: document.getElementById("user-message-specific"),
};

userDom.dataTable = $(userDom.usersTable).DataTable({
  lengthChange: false,
  autoWidth: true,
  scrollX: true,
  select: true,
  scrollCollapse: true,
  buttons: [
    "copy",
    "csv",
    "excel",
    {
      extend: "pdfHtml5",
      orientation: "landscape",
      pageSize: "A4",
      title: () => "Users_" + new Date().toLocaleString(),
    },
    ,
    "print",
    "colvis",
  ],
  fixedColumns: {
    left: 1,
  },
});

userDom.dataTable
  .buttons()
  .container()
  .appendTo("#users-table_wrapper .col-md-6:eq(0)");

var contactFormDom = {
  container: document.getElementById("contact-form-container"),
  form: document.getElementById("contact-form"),
  name: document.getElementById("contact-name"),
  email: document.getElementById("contact-email"),
  phone: document.getElementById("contact-phone"),
  department: document.getElementById("contact-department"),
  profession: document.getElementById("contact-profession"),
  college: document.getElementById("contact-college"),
  event: document.getElementById("contact-event"),
  about: document.getElementById("contact-about"),
  id: document.getElementById("contact-id"),
  path: document.getElementById("contact-path"),
  code: document.getElementById("countryCode"),
};

var eventFormDom = {
  container: document.getElementById("event-form-container"),
  form: document.getElementById("event-form"),
  name: document.getElementById("event-name"),
  icon: document.getElementById("event-icon"),
  icon_val: document.getElementById("event-icon-val"),
  type: document.getElementById("event-type"),
  description: document.getElementById("event-description"),
  short: document.getElementById("event-short"),
  venue: document.getElementById("event-venue"),
  datetime: document.getElementById("event-datetime"),
  amount: document.getElementById("event-amount"),
  organizer: document.getElementById("event-organizer"),
  id: document.getElementById("event-id"),
  path: document.getElementById("event-path"),
};

$(eventFormDom.icon).iconpicker({
  templates: {
    popover:
      '<div class="iconpicker-popover popover border-0"><div class="arrow"></div>' +
      '<div class="popover-title border-0"></div><div class="popover-content"></div></div>',
    iconpicker:
      '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
    iconpickerItem:
      '<a role="button" href="#" class="iconpicker-item"><i></i></a>',
  },
});

var registerDom = {
  container: document.getElementById("register-container"),
  user: document.getElementById("register-name"),
  event: document.getElementById("register-event"),
  form: document.getElementById("register-form"),
};

function setMainContentFromSideBar(value, others) {
  if (value !== "event-list") {
    navbarDom.menu.click();
  }
  setMainContent(value, others);
}

function setMainContent(value, others = {}) {
  mainLoader.hidden = false;

  contactDom.container.hidden = true;
  eventDom.container.hidden = true;
  eventListDom.container.hidden = true;
  eventFormDom.container.hidden = true;
  contactFormDom.container.hidden = true;
  transactDom.container.hidden = true;
  registerDom.container.hidden = true;
  userDom.container.hidden = true;

  contentDom.header.left.innerHTML = "";
  contentDom.header.right.innerHTML = "";
  if (value == "contact") {
    contactDom.container.hidden = false;
    contentDom.header.title.textContent = "Contacts";
    contentDom.header.right.innerHTML = `
      <button class="btn btn-info" onclick="setMainContent('new-contact')">
            <i class="fas fa-plus-square"></i>
                Add Contact
        </button>
      `;
  } else if (value == "event-list") {
    eventListDom.container.hidden = false;
    contentDom.header.title.textContent = "List of Events";
    contentDom.header.right.innerHTML = `
      <button class="btn btn-info" onclick="setMainContent('new-event')">
            <i class="fas fa-plus-square"></i>
                Add Event
        </button>
      `;
  } else if (value == "event") {
    eventDom.container.hidden = false;
    setSpecificEvent(others.id);
  } else if (value == "new-event") {
    eventFormDom.container.hidden = false;
    contentDom.header.title.textContent = "Adding New Event";
    contentDom.header.left.innerHTML = `
        <button class="btn btn-info" onclick="setMainContent('event-list')">
            Back to events
        </button>
      `;
    setEventForm("new");
  } else if (value == "modify-event") {
    eventFormDom.container.hidden = false;
    contentDom.header.left.innerHTML = `
    <button class="btn btn-info" onclick="setMainContent('event-list')">
        Back to events
    </button>
  `;
    contentDom.header.right.innerHTML = `
  <button class="btn btn-info" onclick="setMainContent('new-event')">
        <i class="fas fa-plus-square"></i>
            Add Event
    </button>
  `;
    setEventForm("modify", others.index);
  } else if (value == "new-contact") {
    contactFormDom.container.hidden = false;
    contentDom.header.title.textContent = "Adding New Contact";
    contentDom.header.left.innerHTML = `
        <button class="btn btn-info" onclick="setMainContent('contact')">
            Back to contacts
        </button>
      `;
    setContactForm("new");
  } else if (value == "modify-contact") {
    contactFormDom.container.hidden = false;
    setContactForm("modify", others.index);
    contentDom.header.left.innerHTML = `
    <button class="btn btn-info" onclick="setMainContent('contact')">
        Back to contacts
    </button>
    `;
    contentDom.header.right.innerHTML = `
      <button class="btn btn-info" onclick="setMainContent('new-contact')">
            <i class="fas fa-plus-square"></i>
                Add Contact
        </button>
      `;
  } else if (value == "transactions") {
    transactDom.container.hidden = false;
    contentDom.header.title.textContent = "";
    transactDom.dataTable.columns.adjust();
  } else if (value == "register") {
    contentDom.header.title.textContent = "";
    registerDom.container.hidden = false;
  } else if (value == "users") {
    userDom.container.hidden = false;
    contentDom.header.title.textContent = "";
    userDom.dataTable.columns.adjust();
  }
  mainLoader.hidden = true;
  currentTab = value;
}

// text auto resizing - start
var textarea = document.querySelectorAll("textarea");

function textResizeAll() {
  for (var i of textarea) {
    i.style.height = "auto";
    i.style.height = i.scrollHeight + "px";
  }
}
function textResize() {
  this.style.height = "auto";
  this.style.height = this.scrollHeight + "px";
}
// text auto resizing -end

window.addEventListener("load", async (e) => {
  for (var i of textarea) i.addEventListener("input", textResize, false);

  data = await getRequiredData();

  setContacts();
  setEvents();
  setTransactions();
  setUsers();
  setMainContent(currentTab);

  handleResize();

  setInterval(() => {
    refresh();
  }, 30000);
});

window.addEventListener("resize", handleResize);

function handleResize(e) {
  contentDom.container.style["height"] =
    window.innerHeight - navbarDom.container.clientHeight + "px";
}
// handling data -start

async function getRequiredData() {
  var v1 = await (await fetch("../../actions/get_contacts.php")).json();
  var v2 = await (await fetch("../../actions/get_events.php")).json();
  var v3 = util.classify(
    await (await fetch("../../actions/get_candidates.php")).json(),
    "event_id"
  );
  var v4 = await (await fetch("../../actions/get_transactions.php")).json();
  var v5 = await (await fetch("../../actions/get_users.php")).json();
  return {
    contacts: v1,
    eventList: v2,
    events: v3,
    transactions: v4,
    users: v5,
  };
}

function changeData(newData, showChanges = true) {
  // FOR CONTACTS
  let index = util.changeIndex(data.contacts, newData.contacts);

  // give modification warning
  if (index.length > 0) {
    let body = "";
    for (let i of index) {
      if (i == curr_form_obj && currentTab == "modify-contact") {
        warningModal.content.innerText = `The contact you're editing (${data.contacts[i].name}) is modified by another login,please check contacts before submit the data`;
        warningModal.switch.modal("show");
      }
      body += `<li>${data.contacts[i].name}</li>`;
    }
    if (showChanges)
      $(document).Toasts("create", {
        body:
          "<div class='text-light'>These contacts are modified by another login<ul>" +
          body +
          "</ul></div>",
        title: "Contacts",
        class: "bg-maroon",
        subtitle: "Modified",
        icon: "fas fa-address-book fa-lg",
      });
  }
  // give insertion warning
  if (data.contacts.length < newData.contacts.length) {
    let body = "";
    if (currentTab == "new-contact") {
      warningModal.content.innerText =
        "New contacts are created by another login,please check contacts before submit the data to avoid duplicate entry";
      warningModal.switch.modal("show");
    }
    for (let i = data.contacts.length; i < newData.contacts.length; i++) {
      body += `<li>${newData.contacts[i].name}</li>`;
    }
    if (showChanges)
      $(document).Toasts("create", {
        body:
          "<div class='text-light'>These contacts are created by another login<ul>" +
          body +
          "</ul></div>",
        title: "Contacts",
        class: "bg-info",
        subtitle: "Created",
        icon: "fas fa-address-book fa-lg",
      });
  }
  // modify the data
  if (index.length > 0 || data.contacts.length < newData.contacts.length) {
    data.contacts = newData.contacts;
    setContacts();
  }

  //  FOR EVENT LIST
  index = util.changeIndex(data.eventList, newData.eventList);

  // give modification warning
  if (index.length > 0) {
    let body = "";
    for (let i of index) {
      if (i == curr_form_obj && currentTab == "modify-event") {
        warningModal.content.innerText = `The event you're editing (${data.eventList[i].name}) is modified by another login,please check events list before submit the data`;
        warningModal.switch.modal("show");
      }
      body += `<li>${data.eventList[i].name}</li>`;
    }
    if (showChanges)
      $(document).Toasts("create", {
        body:
          "<div class='text-light'>These events are modified by another login<ul>" +
          body +
          "</ul></div>",
        title: "Events",
        class: "bg-maroon",
        subtitle: "Modified",
        icon: "fas fa-address-book fa-lg",
      });
  }
  // give insertion warning
  if (data.eventList.length < newData.eventList.length) {
    let body = "";
    if (currentTab == "new-event") {
      warningModal.content.innerText =
        "New events are created by another login,please check events list before submit the data to avoid duplicate entries";
      warningModal.switch.modal("show");
    }
    for (let i = data.eventList.length; i < newData.eventList.length; i++) {
      body += `<li>${newData.eventList[i].name}</li>`;
    }
    if (showChanges)
      $(document).Toasts("create", {
        body:
          "<div class='text-light'>These events are created by another login<ul>" +
          body +
          "</ul></div>",
        title: "Events",
        class: "bg-info",
        subtitle: "Created",
        icon: "fas fa-address-book fa-lg",
      });
  }
  // modify the data

  if (index.length > 0 || data.eventList.length < newData.eventList.length) {
    data.eventList = newData.eventList;
    setEvents();
  }

  // FOR Specific event

  if (currentTab == "event") {
    let o = data.events[curr_form_obj];
    let n = newData.events[curr_form_obj];
    data.events = newData.events;
    if (o.length != n.length || util.changeIndex(o, n).length > 0) {
      setSpecificEvent(curr_form_obj, "table");
    }
    if (index.length > 0) {
      setSpecificEvent(curr_form_obj, "meta");
    }
  } else {
    data.events = newData.events;
  }

  if (
    data.transactions.length != newData.transactions.length ||
    util.changeIndex(data.transactions, newData.transactions).length > 0 ||
    index.length > 0
  ) {
    data.transactions = newData.transactions;
    setTransactions();
  }

  if (
    data.users.length != newData.users.length ||
    util.changeIndex(data.users, newData.users).length > 0 ||
    index.length > 0
  ) {
    data.users = newData.users;
    setUsers();
  }
}

async function refresh(showChanges = true) {
  console.log("refreshed");
  navbarDom.refreshIcon.classList.add("fa-spin");
  changeData(await getRequiredData(), showChanges);
  contentDom.lastCheck.textContent =
    "Last Refreshed " + new Date().toLocaleTimeString();
  navbarDom.refreshIcon.classList.remove("fa-spin");
}
// handling data - end

// separate content setters

function setContacts() {
  var half = data.contacts.length / 2;
  let str = "";
  let str1 = "";
  let str2 = "";
  let i = 0;
  for (; i < half; i++) {
    let t = data.contacts[i];
    str += `<option value="${t.contact_id}">${t.name}</option>`;
    str1 += `
    <div class="card card-widget card-dark collapsed-card">
    <div class="card-header" data-card-widget="collapse">
        <div class="user-block">
            <img class="img-circle" src="../../uploads/contacts/${t.profile_path}" alt="User Image">
            <span class="username"><a href="#">${t.name}</a></span>
            <span class="description">${t.profession} - ${t.college}</span>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool"></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-tool" onclick="setMainContent('modify-contact',{index:${i}})">
                <i class="fas fa-pen"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">Name</dt>
            <dd class="col-sm-8">${t.name}</dd>
            <dt class="col-sm-4">Email</dt>
            <dd class="col-sm-8">${t.mail}</dd>
            <dt class="col-sm-4">Phone</dt>
            <dd class="col-sm-8">${t.phone}</dd>
            <dt class="col-sm-4">Profession</dt>
            <dd class="col-sm-8">${t.profession}</dd>
            <dt class="col-sm-4">Department</dt>
            <dd class="col-sm-8">${t.department}</dd>
            <dt class="col-sm-4">College</dt>
            <dd class="col-sm-8">${t.college}</dd>
            <dt class="col-sm-4">Event</dt>
            <dd class="col-sm-8">${t.event}</dd>
            <dt class="col-sm-4">About</dt>
            <dd class="col-sm-8">${t.about}</dd>
        </dl>
    </div>
  </div>
    `;
  }

  for (; i < data.contacts.length; i++) {
    let t = data.contacts[i];
    str += `<option value="${t.contact_id}">${t.name}</option>`;
    str2 += `
    <div class="card card-widget card-dark collapsed-card">
    <div class="card-header" data-card-widget="collapse">
        <div class="user-block">
            <img class="img-circle" src="../../uploads/contacts/${t.profile_path}" alt="User Image">
            <span class="username"><a href="#">${t.name}</a></span>
            <span class="description">${t.profession} - ${t.college}</span>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool"></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-tool"  onclick="setMainContent('modify-contact',{index:${i}})">
                <i class="fas fa-pen"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">Name</dt>
            <dd class="col-sm-8">${t.name}</dd>
            <dt class="col-sm-4">Email</dt>
            <dd class="col-sm-8">${t.mail}</dd>
            <dt class="col-sm-4">Phone</dt>
            <dd class="col-sm-8">${t.phone}</dd>
            <dt class="col-sm-4">Profession</dt>
            <dd class="col-sm-8">${t.profession}</dd>
            <dt class="col-sm-4">Department</dt>
            <dd class="col-sm-8">${t.department}</dd>
            <dt class="col-sm-4">College</dt>
            <dd class="col-sm-8">${t.college}</dd>
            <dt class="col-sm-4">Event</dt>
            <dd class="col-sm-8">${t.event}</dd>
            <dt class="col-sm-4">About</dt>
            <dd class="col-sm-8">${t.about}</dd>
        </dl>
    </div>
  </div>
    `;
  }
  // eventFormDom.organizer.innerHTML = str;
  contactDom.containerLeft.innerHTML = str1;
  contactDom.containerRight.innerHTML = str2;
}

function setEvents() {
  var quat = data.eventList.length / 3;
  let str1 = "";
  let str2 = "";
  let str3 = "";
  let list = "";
  let i = 0;
  for (; i < quat; i++) {
    let t = data.eventList[i];
    str1 += `
    <div class="card card-widget" onclick="setEventModal(${i})">
    <img class="card-img-top" src="../../uploads/events/${t.image_path}" alt="event image">
    <div class="card-header">
        <h3 class="card-title">
            <i class="${t.icon_class}"></i>&nbsp;&nbsp;
            ${t.name}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool"></button>
            <button type="button" class="btn btn-tool"
              onclick="setMainContent('event',{id:'${t.event_id}'})")">
              <i class="fas fa-external-link-alt"></i>
            </button>
            <button type="button" class="btn btn-tool"
                onclick="setMainContent('modify-event',{index:${i}})">
                <i class="fas fa-pen"></i>
            </button>
        </div>
    </div>
  </div>
    `;
  }
  quat *= 2;

  for (; i < quat; i++) {
    let t = data.eventList[i];
    str2 += `
    <div class="card card-widget" onclick="setEventModal(${i})">
    <img class="card-img-top" src="../../uploads/events/${t.image_path}" alt="event image">
    <div class="card-header">
    <h3 class="card-title">
        <i class="${t.icon_class}"></i>&nbsp;&nbsp;
        ${t.name}
    </h3>
      <div class="card-tools">
            <button type="button" class="btn btn-tool"></button>
            <button type="button" class="btn btn-tool"
              onclick="setMainContent('event',{id:'${t.event_id}'})")">
              <i class="fas fa-external-link-alt"></i>
            </button>
            <button type="button" class="btn btn-tool"
                onclick="setMainContent('modify-event',{index:${i}})">
                <i class="fas fa-pen"></i>
            </button>
        </div>
    </div>
  </div>
    `;
  }

  quat = data.eventList.length;

  for (; i < quat; i++) {
    let t = data.eventList[i];
    str3 += `
    <div class="card card-widget" onclick="setEventModal(${i})">
    <img class="card-img-top" src="../../uploads/events/${t.image_path}" alt="event image">
    <div class="card-header">
    <h3 class="card-title">
        <i class="${t.icon_class}"></i>&nbsp;&nbsp;
        ${t.name}
    </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool"></button>
            <button type="button" class="btn btn-tool"
              onclick="setMainContent('event',{id:'${t.event_id}'})")">
              <i class="fas fa-external-link-alt"></i>
            </button>
            <button type="button" class="btn btn-tool"
                onclick="setMainContent('modify-event',{index:${i}})">
                <i class="fas fa-pen"></i>
            </button>
        </div>
    </div>
  </div>
    `;
  }

  let str = "";
  for (let i of data.eventList) {
    list += `<li class="nav-item" onclick="setMainContentFromSideBar('event',{id:'${i.event_id}'})">
              <a href="#" class="nav-link">
                  <p>${i.name}</p>
              </a>
            </li>`;
    str += `<option value="${i.event_id}">${i.name}</option>`;
  }

  sidebarDom.eventListContainer.innerHTML = list;
  eventListDom.containerLeft.innerHTML = str1;
  eventListDom.containerMid.innerHTML = str2;
  eventListDom.containerRight.innerHTML = str3;
  registerDom.event.innerHTML = str;
  contactFormDom.event.innerHTML =
    "<option selected value='--'>Not Selected</option>" + str;
}

function setTransactions() {
  let d = [];
  for (let i in data.transactions) {
    let t = data.transactions[i];
    d.push([
      `<a href='#' onclick="setTransactionModal(${i})">Change>></a>`,
      t.s_no,
      t.user_name,
      t.user_mail,
      t.user_phone,
      t.name,
      t.event_amt,
      t.payment_id,
      t.paid_amt,
      // i.paid_amt_currency,
      t.payment_status,
      // i.stripe_checkout_session_id,
      // i.txn_id,
      t.created,
      t.modified,
    ]);
  }
  transactDom.dataTable.clear().rows.add(d).draw();
}

function setUsers() {
  let d = [];
  let selectData = [];
  let str = "";

  data.users.forEach((v, i) => {
    d.push([
      `<a href='#' onclick="setUserModal(${i})">More>></a>`,
      v.s_no,
      v.user_name,
      v.user_mail,
      v.user_phone,
      v.user_time,
      v.amt_required,
      v.amt_paid,
      v.status,
      util.getEvtNames(v.events, v.user_id) || "None",
    ]);
    str += `<option value="${v.user_id}">${v.user_name}</option>`;
    selectData.push({ text: v.user_name, id: i });
  });

  registerDom.user.innerHTML = str;
  userDom.dataTable.clear().rows.add(d).draw();

  // setting select2
  composeWindow.selectUser1.select2("destroy");
  composeWindow.user.innerHTML = "";
  composeWindow.selectUser1.select2({
    data: selectData,
    tags: false,
    width: "max-content",
    dropdownAutoWidth: true,
    multiple: true,
    placeholder: "Select users",
    containerCssClass: "border-0",
  });

  // setting message
  userDom.userMsgAll.onclick = () => {
    composeWindow.send.onclick = () => userMailSubmit(true);
    composeWindow.title.textContent = "Message to All Candidates";
    composeWindow.user1Container.hidden = true;
    composeWindow.userContainer.hidden = true;
    composeWindow.container.style.display = "block";
  };
  userDom.userMsgSpecific.onclick = () => {
    composeWindow.send.onclick = () => userMailSubmit(false);
    composeWindow.title.textContent = "Message";
    composeWindow.user1Container.hidden = false;
    composeWindow.userContainer.hidden = true;
    composeWindow.container.style.display = "block";
  };
}

function setEventForm(type = "new", index) {
  event.stopPropagation();
  event.preventDefault();
  normalModal.switch.modal("hide");

  fileDom.eventImageConform.value = "0";

  if (type == "new") {
    eventFormDom.name.value = "";
    eventFormDom.description.value = "";
    eventFormDom.short.value = "";
    eventFormDom.venue.value = "";
    eventFormDom.datetime.value = "";
    eventFormDom.amount.value = "";
    eventFormDom.organizer.value = "";
    eventFormDom.id.value = "";
    eventFormDom.type.value = "";
    eventFormDom.icon_val.className = "";
    eventFormDom.path.value = "default.png";
    fileDom.eventImage.src = "../../uploads/events/default.png";
    fileDom.eventImageRemove.hidden = true;
    fileDom.eventImageReset.hidden = true;
    fileDom.eventImageReset.style.display = "none";
  } else {
    let t = data.eventList[index];
    curr_form_obj = index;
    eventFormDom.name.value = t.name;

    eventFormDom.short.value = t.short;
    eventFormDom.short.style.height = eventFormDom.short.scrollHeight + "px";

    eventFormDom.description.value = t.description;
    eventFormDom.description.style.height =
      eventFormDom.description.scrollHeight + "px";
    eventFormDom.venue.value = t.venue;
    eventFormDom.datetime.value = t.date_time;
    eventFormDom.amount.value = t.amount;
    eventFormDom.organizer.value = t.organizer;
    eventFormDom.organizer.style.height =
      eventFormDom.organizer.scrollHeight + "px";
    eventFormDom.type.value = t.event_type;
    eventFormDom.icon_val.className = t.icon_class;
    eventFormDom.id.value = t.event_id;
    eventFormDom.path.value = t.image_path;
    contentDom.header.title.textContent = "Modifying " + t.name;
    fileDom.eventImage.src = "../../uploads/events/" + t.image_path;
    fileDom.eventImageRemove.hidden = false;
    fileDom.eventImageReset.hidden = true;
    fileDom.eventImageReset.style.display = "initial";
  }
}

function submitEventForm(variant = currentTab) {
  let url = "../../actions/add_event.php";
  if (variant == "modify-event") {
    url = "../../actions/modify_event.php";
  }

  fetch(url, {
    headers: {
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({
      name: eventFormDom.name.value,
      desc: eventFormDom.description.value,
      venue: eventFormDom.venue.value,
      type: eventFormDom.type.value,
      short: eventFormDom.short.value,
      icon: eventFormDom.icon_val.className,
      amount: eventFormDom.amount.value,
      datetime: eventFormDom.datetime.value,
      organizer: eventFormDom.organizer.value,
      id: eventFormDom.id.value,
      path: eventFormDom.path.value,
      image_conformation: fileDom.eventImageConform.value,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status == "success") {
        let title;
        if (currentTab == "new-event") {
          title = eventFormDom.name.value + " event added successfully";
        } else {
          title = eventFormDom.name.value + " event modified successfully";
        }
        Toast.fire({ icon: "success", title });
        eventFormDom.form.reset();
        refresh(false);
        setMainContent("event-list");
      } else {
        let html = "<b>Failed (thrown from server)</b>";
        if (currentTab == "new-event") {
          html += `<p>Adding ${eventFormDom.name.value} event is failed due to <span class="bg-danger">${data.reason}</span>, please check and correct the errors</p>`;
        } else {
          html += `<p>Modifing ${eventFormDom.name.value} event is failed due to <span class="bg-danger">${data.reason}</span>, please check and correct the errors</p>`;
        }
        warningModal.content.innerHTML = html;
        warningModal.switch.modal("show");
      }
    });
  return false;
}

function submitContactForm(variant = currentTab) {
  let url = "../../actions/add_contact.php";
  if (variant == "modify-contact") {
    url = "../../actions/modify_contact.php";
  }

  fetch(url, {
    headers: {
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({
      name: contactFormDom.name.value,
      email: contactFormDom.email.value,
      college: contactFormDom.college.value,
      profession: contactFormDom.profession.value,
      department: contactFormDom.department.value,
      id: contactFormDom.id.value,
      path: contactFormDom.path.value,
      event: contactFormDom.event.value,
      phone: contactFormDom.phone.value,
      about: contactFormDom.about.innerHTML,
      code: contactFormDom.code.value,
      image_conformation: fileDom.contactImageConform.value,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status == "success") {
        let title;
        if (currentTab == "new-contact") {
          title =
            contactFormDom.name.value +
            " details in contact added successfully";
        } else {
          title =
            contactFormDom.name.value +
            " details in contact modified successfully";
        }
        Toast.fire({ icon: "success", title });
        contactFormDom.form.reset();
        refresh(false);
        setMainContent("contact");
      } else {
        let html = "<b>Failed (thrown from server)</b>";
        if (currentTab == "new-contact") {
          html += `<p>Adding ${contactFormDom.name.value} contact is failed due to <span class="bg-danger">${data.reason}</span>, please check and correct the errors</p>`;
        } else {
          html += `<p>Modifing ${contactFormDom.name.value} contact is failed due to <span class="bg-danger">${data.reason}</span>, please check and correct the errors</p>`;
        }
        warningModal.content.innerHTML = html;
        warningModal.switch.modal("show");
      }
    });
  return false;
}

function setContactForm(type = "new", index) {
  event.stopPropagation();
  event.preventDefault();
  fileDom.contactImageConform.value = "0";

  if (type == "new") {
    contactFormDom.name.value = "";
    contactFormDom.email.value = "";
    contactFormDom.college.value = "";
    contactFormDom.profession.value = "";
    contactFormDom.department.value = "";
    contactFormDom.id.value = "";
    contactFormDom.path.value = "default.png";
    contactFormDom.event.value = "--";
    contactFormDom.phone.value = "";
    contactFormDom.about.textContent = "";
    fileDom.contactImage.src = "../../uploads/contacts/default.png";
    fileDom.contactImageRemove.hidden = true;
    fileDom.contactImageReset.hidden = true;
    fileDom.contactImageReset.style.display = "none";
  } else {
    let t = data.contacts[index];
    curr_form_obj = index;
    let p = t.phone.split(" ");
    contactFormDom.name.value = t.name;
    contactFormDom.email.value = t.mail;
    contactFormDom.college.value = t.college;
    contactFormDom.id.value = t.contact_id;
    contactFormDom.path.value = t.profile_path;
    contactFormDom.profession.value = t.profession;
    contactFormDom.department.value = t.department;
    contactFormDom.event.value = t.event_id;
    contactFormDom.code.value = p[0].substring(1);
    contactFormDom.phone.value = p[1];
    contactFormDom.about.textContent = t.about;
    contactFormDom.about.style.height =
      contactFormDom.about.scrollHeight + "px";
    contentDom.header.title.textContent = "Modifying " + t.name;
    fileDom.contactImage.src = "../../uploads/contacts/" + t.profile_path;
    fileDom.contactImageRemove.hidden = false;
    fileDom.contactImageReset.hidden = true;
    fileDom.contactImageReset.style.display = "initial";
  }
}

function setSpecificEvent(event_id, drawOnly = "all") {
  event.stopPropagation();
  event.preventDefault();
  normalModal.switch.modal("hide");

  contentDom.header.title.textContent = "";
  curr_form_obj = event_id;
  let e = data.events[event_id] || [];
  let meta = util.findFirst(data.eventList, "event_id", event_id);
  if (drawOnly == "all" || drawOnly == "table") {
    let d = [];
    for (let i in e) {
      let t = e[i];
      d.push([
        `<a href='#' onclick="setCandidateModal('${event_id}',${i})">More>></a>`,
        t.s_no,
        t.reg_id,
        t.user_name,
        t.user_mail,
        t.user_phone,
        // t.paid_amt,
        // t.paid_amt_currency,
        // t.payment_id,
        t.token,
        t.status,
        t.remark,
      ]);
    }
    eventDom.dataTable.clear().rows.add(d).draw();
  }
  if (drawOnly == "all" || drawOnly == "meta") {
    eventDom.metaDataTitle.textContent = meta.name;
    eventDom.metaDataBody.innerHTML = `
  <dl class="row">
    <dt class="col-sm-4">Name</dt>
    <dd class="col-sm-8">${meta.name}</dd>
    <dt class="col-sm-4">Description</dt>
    <dd class="col-sm-8">${meta.description}</dd>
    <dt class="col-sm-4">Venue</dt>
    <dd class="col-sm-8">${meta.venue}</dd>
    <dt class="col-sm-4">Date Time</dt>
    <dd class="col-sm-8">${meta.date_time}</dd>
    <dt class="col-sm-4">Amount(₹)</dt>
    <dd class="col-sm-8">${meta.amount}</dd>
    <dt class="col-sm-4">Organizer</dt>
    <dd class="col-sm-8">${meta.organizer}</dd>
    </dl>
`;
  }

  // setting select2 only need when table changes
  if (drawOnly == "all" || drawOnly == "table") {
    composeWindow.selectUser.select2("destroy");
    composeWindow.user.innerHTML = "";
    let selectData = [];
    for (let i in e) selectData.push({ text: e[i].user_name, id: i });

    composeWindow.selectUser.select2({
      data: selectData,
      tags: false,
      width: "max-content",
      dropdownAutoWidth: true,
      multiple: true,
      placeholder: "Select users",
      containerCssClass: "border-0",
    });
  }
  // setting message
  setCandidateMail(event_id);
}

function setCandidateMail(event_id) {
  eventDom.candidateMsgAll.onclick = () => {
    composeWindow.send.onclick = () => candidateMailSubmit(event_id, true);
    composeWindow.title.textContent = "Message to All Candidates";
    composeWindow.userContainer.hidden = true;
    composeWindow.user1Container.hidden = true;
    composeWindow.container.style.display = "block";
  };
  eventDom.candidateMsgSpecific.onclick = () => {
    composeWindow.send.onclick = () => candidateMailSubmit(event_id, false);
    composeWindow.title.textContent = "Message";
    composeWindow.userContainer.hidden = false;
    composeWindow.user1Container.hidden = true;
    composeWindow.container.style.display = "block";
  };
}

function goToModal(modalType, event_id, user_id) {
  if (modalType == "candidate") {
    let t = data.events[event_id] || [];
    for (let i in t) {
      if (t[i].user_id == user_id) {
        setCandidateModal(event_id, i);
      }
    }
  } else {
    let t = data.transactions;
    for (let i in t)
      if (t[i].event_id == event_id && t[i].user_id == user_id)
        setTransactionModal(i);
  }
}

function setEventModal(index) {
  let t = data.eventList[index];
  normalModal.title.innerHTML = `${t.name} <div class="float-right">
    <button type="button" data-dismiss="modal" class="btn btn-tool"
        onclick="setMainContent('event',{id:'${t.event_id}'})")">
        <i class="fas fa-external-link-alt"></i>
    </button>
    <button type="button" data-dismiss="modal" class="btn btn-tool"
        onclick="setMainContent('modify-event',{index:${index}})">
        <i class="fas fa-pen"></i>
    </button>
  </div>`;
  normalModal.content.innerHTML = `
    <dl>
      <dt>Name</dt>
      <dd class="ml-3">${t.name}</dd>
      <dt>Type</dt>
      <dd class="ml-3">${t.event_type}</dd>
      <dt>Short Description</dt>
      <dd class="ml-3">${t.short}</dd>
      <dt>Description</dt>
      <dd class="ml-3">${t.description}</dd>
      <dt>Venue</dt>
      <dd class="ml-3">${t.venue}</dd>
      <dt>Date Time</dt>
      <dd class="ml-3">${t.date_time}</dd>
      <dt>Amount(₹)</dt>
      <dd class="ml-3">${t.amount}</dd>
      <dt>Organizer</dt>
      <dd class="ml-3">${t.organizer}</dd>
  </dl>`;
  normalModal.switch.modal("show");
}

function setCandidateModal(event_id, index) {
  let t = data.events[event_id][index];
  normalModal.title.textContent =
    t.user_name + " - " + t.name + " (Candidate Details)";
  normalModal.content.innerHTML = `
  <dl class="row">
    <dt class="col-sm-4">S.No</dt>
    <dd class="col-sm-8">${t.s_no}</dd>
    <dt class="col-sm-4">Name</dt>
    <dd class="col-sm-8">${t.user_name}</dd>
    <dt class="col-sm-4">Mail</dt>
    <dd class="col-sm-8">${t.user_mail}</dd>
    <dt class="col-sm-4">Phone</dt>
    <dd class="col-sm-8">${t.user_phone}</dd>
    <dt class="col-sm-4">Candidate Id</dt>
    <dd class="col-sm-8">${t.reg_id}</dd>
    <dt class="col-sm-4">Key Code</dt>
    <dd class="col-sm-8">${t.token}</dd>
    <dt class="col-sm-4">Registered At</dt>
    <dd class="col-sm-8">${t.date_time}</dd>
    <dt class="col-sm-4">Status</dt>
    <dd class="col-sm-8">
      <select class="form-control" 
      onchange="candidateModalChangeHandler(this,'status','${
        t.event_id
      }',${index})">
        <option ${t.status == "red" ? "selected" : ""} value="red">Red</option>
        <option ${
          t.status == "yellow" ? "selected" : ""
        } value="yellow">Yellow</option>
        <option ${
          t.status == "green" ? "selected" : ""
        } value="green">Green</option>
      </select>
    </dd>
    <dt class="col-sm-4">Remark</dt>
    <dd class="col-sm-8"><input oninput="candidateModalChangeHandler(this,'remark','${
      t.event_id
    }',${index})" class="form-control" value="${t.remark}"></dd>
    <dt class="col-sm-4">Event</dt>
    <dd class="col-sm-8">${t.name}</dd>

     </dl>
    `;
  // <button onclick="goToModal('transaction','${t.event_id}','${
  //   t.user_id
  // }')" class="btn btn-flat btn-dark">View Transaction Details</button>

  // <dt class="col-sm-4">Required Amt</dt>
  // <dd class="col-sm-8">${t.event_amt} INR</dd>
  // <dt class="col-sm-4">Paid</dt>
  // <dd class="col-sm-8">${t.paid_amt}</dd>
  // <dt class="col-sm-4">Payment Id</dt>
  // <dd class="col-sm-8">${t.payment_id}</dd>

  normalModal.save.onclick = () =>
    candidateModalSubmit(event_id, index, "false");
  normalModal.saveAlert.onclick = () =>
    candidateModalSubmit(event_id, index, "true");
  normalModal.switch.modal("show");
}

function setUserModal(index) {
  let t = data.users[index];
  normalModal.title.textContent = t.user_name + " (User Details)";
  normalModal.content.innerHTML = `
  <dl class="row">
    <dt class="col-sm-4">User ID</dt>
    <dd class="col-sm-8">${t.user_id}</dd>
    <dt class="col-sm-4">Name</dt>
    <dd class="col-sm-8">${t.user_name}</dd>
    <dt class="col-sm-4">Mail</dt>
    <dd class="col-sm-8">${t.user_mail}</dd>
    <dt class="col-sm-4">Phone</dt>
    <dd class="col-sm-8">${t.user_phone}</dd>
    <dt class="col-sm-4">Registered At</dt>
    <dd class="col-sm-8">${t.user_time}</dd>
    <dt class="col-sm-4">Amt Required</dt>
    <dd class="col-sm-8">${t.amt_required} INR</dd>
    <dt class="col-sm-4">Amt Paid</dt>
    <dd class="col-sm-8"><input type="number" oninput="userModalChangeHandler(this,'amt_paid',${index})" class="form-control" value="${
    t.amt_paid
  }"></dd>
    <dt class="col-sm-4">Status</dt>
    <dd class="col-sm-8">
    <select class="form-control"
    onchange="userModalChangeHandler(this,'status',${index})">
    <option ${t.status == "paid" ? "selected" : ""} value="paid">Paid</option>
    <option ${
      t.status == "partially-paid" ? "selected" : ""
    } value="partially-paid">Partially Paid</option>
    <option ${
      t.status == "not-paid" ? "selected" : ""
    } value="not-paid">Not Paid</option>
      </select>
      </dd>      
    <dt class="col-sm-4">Events Registered</dt>
    <dd class="col-sm-8">${util.getEvtNames(t.events, t.user_id) || "None"}</dd>
     </dl>
    `;

  normalModal.save.onclick = () => userModalSubmit(index, false);
  normalModal.saveAlert.onclick = () => userModalSubmit(index, true);
  normalModal.switch.modal("show");
}

async function setRegisterModal() {
  normalModal.register.className = "btn btn-primary btn-flat";
  normalModal.register.innerHTML = "Confirm";
  normalModal.register.disabled = false;
  normalModal.register.hidden = false;

  normalModal.save.hidden = true;
  normalModal.saveAlert.hidden = true;

  let t = await util.findFirst(
    data.eventList,
    "event_id",
    registerDom.event.value
  );

  let user = await util.findFirst(
    data.users,
    "user_id",
    registerDom.user.value
  );
  normalModal.title.innerHTML = `Registering ${t.name} for ${user.user_name}`;

  normalModal.content.innerHTML = await `
  <dl>
    <dt>Name</dt>
    <dd class="ml-3">${t.name}</dd>
    <dt>Type</dt>
    <dd class="ml-3">${t.event_type}</dd>
    <dt>Description</dt>
    <dd class="ml-3">${t.description}</dd>
    <dt>Venue</dt>
    <dd class="ml-3">${t.venue}</dd>
    <dt>Date Time</dt>
    <dd class="ml-3">${t.date_time}</dd>
    <dt>Amount(₹)</dt>
    <dd class="ml-3">${t.amount}</dd>
    <dt>Organizer</dt>
    <dd class="ml-3">${t.organizer}</dd>
  </dl>`;

  normalModal.register.onclick = () => submitRegisterForm();
  await normalModal.switch.modal("show");

  return false;
}

function submitRegisterForm() {
  normalModal.register.disabled = true;
  normalModal.register.innerHTML = `<span style="width:1.5rem;height:1.5rem;" class="spinner-border text-light" role="status">
      <span class="sr-only">Loading...</span>
      </span> Registering`;

  fetch("../../actions/register.php", {
    headers: {
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({
      user_id: registerDom.user.value,
      event_id: registerDom.event.value,
    }),
  })
    .then((res) => res.json())
    // .then((res) => res.text())
    .then((data) => {
      console.log(data);
      normalModal.register.disabled = false;
      if (data.code == "1") {
        // successful
        normalModal.register.className = "btn btn-success btn-flat";
        normalModal.register.innerHTML =
          "<i class='far fa-check-circle'></i> Registered successfully";
        refresh();
      } else if (data.code == "2") {
        // already registered
        normalModal.register.className = "btn btn-success btn-flat";
        normalModal.register.innerHTML =
          "<i class='far fa-check-circle'></i> Already Registered";
      } else {
        // failed
        normalModal.register.className = "btn btn-danger btn-flat";
        normalModal.register.innerHTML =
          "<i class='far fa-times-circle'></i> Registration Failed";
        warningModal.content.innerHTML = `Registration is failed due to '${data.reason}'`;
        warningModal.switch.modal("show");
      }
      normalModal.register.onclick = () => {
        normalModal.switch.modal("hide");
        normalModal.register.hidden = true;
      };
    });
}

function setTransactionModal(index) {
  let t = data.transactions[index];
  normalModal.title.textContent =
    t.user_name + " - " + t.name + " (Transaction Details)";
  normalModal.content.innerHTML = `
  <dl class="row">
    <dt class="col-sm-4">Name</dt>
    <dd class="col-sm-8">${t.user_name}</dd>
    <dt class="col-sm-4">Mail</dt>
    <dd class="col-sm-8">${t.user_mail}</dd>
    <dt class="col-sm-4">Phone</dt>
    <dd class="col-sm-8">${t.user_phone}</dd>
    <dt class="col-sm-4">Event</dt>
    <dd class="col-sm-8">${t.name}</dd>
    <dt class="col-sm-4">Required Amt</dt>
    <dd class="col-sm-8">${t.event_amt} INR</dd>
    <dt class="col-sm-4">Payment Id</dt>
    <dd class="col-sm-8">${t.payment_id}</dd>
    <dt class="col-sm-4">Payment Status</dt>
    <dd class="col-sm-8">
      <select class="form-control" 
      onchange="transactionModalChangeHandler(this,'payment_status',${index})">
        <option ${
          t.payment_status == "paid" ? "selected" : ""
        } value="paid">Paid</option>
        <option ${
          t.payment_status == "not-paid" ? "selected" : ""
        } value="not-paid">Not Paid</option>
      </select>
    </dd>
    <dt class="col-sm-4">Paid</dt>
    <dd class="col-sm-8"><input type="number" oninput="transactionModalChangeHandler(this,'paid_amt',${index})" class="form-control" value="${
    t.paid_amt
  }"></dd>
    <dt class="col-sm-4">Registered At</dt>
    <dd class="col-sm-8">${t.created}</dd>
    <dt class="col-sm-4">Modified At</dt>
    <dd class="col-sm-8">${t.modified}</dd>
     </dl>
     <button onclick="goToModal('candidate','${t.event_id}','${
    t.user_id
  }')" class="btn btn-flat btn-dark">View Candidate Details</button>
    `;
  normalModal.save.onclick = () => transactionModalSubmit(index, false);
  normalModal.saveAlert.onclick = () => transactionModalSubmit(index, true);
  normalModal.switch.modal("show");
}

var candidateModalChangeHandler = (element, input, event, index) => {
  data.events[event][index]["temp_" + input] = element.value;
  normalModal.save.hidden = false;
  normalModal.saveAlert.hidden = false;
};

var userModalChangeHandler = (element, input, index) => {
  data.users[index]["temp_" + input] = element.value;
  normalModal.save.hidden = false;
  normalModal.saveAlert.hidden = true;
};

var transactionModalChangeHandler = (element, input, index) => {
  data.transactions[index]["temp_" + input] = element.value;
  normalModal.save.hidden = false;
  normalModal.saveAlert.hidden = false;
};

var candidateModalSubmit = (event_id, index, needMail) => {
  let e = data.events[event_id][index];

  if (e.status !== e.temp_status || e.remark !== e.temp_remark) {
    fetch("../../actions/modify_candidate.php", {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify({
        reg_id: e.reg_id,
        status: e.temp_status || e.status,
        remark: e.temp_remark || e.remark,
        needMail,
      }),
    })
      // .then((res) => res.text())
      .then((res) => res.json())
      .then((data) => {
        if (data.status == "success") {
          e.status = e.temp_status || e.status;
          e.remark = e.temp_remark || e.remark;
          e.temp_status = undefined;
          e.temp_remark = undefined;
          // change row data
          eventDom.dataTable
            .row(index)
            .data([
              `<a href='#' onclick="setCandidateModal('${event_id}',${index})">More>></a>`,
              e.s_no,
              e.reg_id,
              e.user_name,
              e.user_mail,
              e.user_phone,
              // t.paid_amt,
              // t.paid_amt_currency,
              // t.payment_id,
              e.token,
              e.status,
              e.remark,
            ])
            .draw();
        } else {
          console.log(data.reason);
        }
      });
  }

  normalModal.save.hidden = true;
  normalModal.saveAlert.hidden = true;
};

var transactionModalSubmit = (index, needMail) => {
  let e = data.transactions[index];

  if (
    e.paid_amt !== e.temp_paid_amt ||
    e.payment_status !== e.temp_payment_status
  ) {
    fetch("../../actions/modify_transaction.php", {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify({
        payment_id: e.payment_id,
        paid_amt: e.temp_paid_amt || e.paid_amt,
        payment_status: e.temp_payment_status || e.payment_status,
        needMail,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status == "success") {
          e.paid_amt = e.temp_paid_amt || e.paid_amt;
          e.payment_status = e.temp_payment_status || e.payment_status;
          e.temp_paid_amt = undefined;
          e.temp_payment_status = undefined;
          // change row data
          transactDom.dataTable
            .row(index)
            .data([
              `<a href='#' onclick="setTransactionModal(${index})">Change>></a>`,
              e.s_no,
              e.user_name,
              e.user_mail,
              e.user_phone,
              e.name,
              e.event_amt,
              e.payment_id,
              e.paid_amt,
              // e.paid_amt_currency,
              e.payment_status,
              // e.stripe_checkout_session_id,
              // e.txn_id,
              e.created,
              e.modified,
            ])
            .draw();
        } else {
          console.log(data.reason);
        }
      });
  }

  normalModal.save.hidden = true;
  normalModal.saveAlert.hidden = true;
};

var userModalSubmit = (index, needMail) => {
  let e = data.users[index];

  if (e.status !== e.temp_status || e.temp_amt_paid != e.amt_paid) {
    fetch("../../actions/modify_user.php", {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify({
        user_id: e.user_id,
        status: e.temp_status || e.status,
        amt_paid: e.temp_amt_paid || e.amt_paid,
        needMail,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status == "success") {
          e.status = e.temp_status || e.status;
          e.amt_paid = e.temp_amt_paid || e.amt_paid;
          e.temp_status = undefined;
          e.temp_amt_paid = undefined;
          // change row data
          userDom.dataTable
            .row(index)
            .data([
              `<a href='#' onclick="setUserModal(${index})">More>></a>`,
              e.s_no,
              e.user_name,
              e.user_mail,
              e.user_phone,
              e.user_time,
              e.amt_required,
              e.amt_paid,
              e.status,
              util.getEvtNames(e.events, e.user_id) || "None",
            ])
            .draw();
        } else {
          console.log(data.reason);
        }
      });
  }

  normalModal.save.hidden = true;
  normalModal.saveAlert.hidden = true;
};

var candidateMailSubmit = (event_id, toAll = false) => {
  composeWindow.container.style.display = "none";
  let t = data.events[event_id] || [];
  if (!toAll) {
    let indexes = composeWindow.selectUser.val();
    let temp = [];
    for (let i of indexes) {
      temp.push(t[i]);
    }
    t = temp;
  }

  let s1 = composeWindow.content.value.replace(/\\/g, "").replace(/`/g, "\\`");
  let s2 = composeWindow.subject.value.replace(/\\/g, "").replace(/`/g, "\\`");

  for (let i of t) {
    let time = i.date_time;
    let amount = i.event_amt;
    let event_name = i.name;
    let paid = i.paid_amt;
    // let currency = i.paid_amt_currency;
    let pay_id = i.payment_id;
    let reg_id = i.reg_id;
    let remark = i.remark;
    let status = i.status;
    let key_code = i.token;
    // let txn_id = i.txn_id;
    let mail = i.user_mail;
    let name = i.user_name;
    let phone = i.user_phone;
    let msg = eval("`" + s1 + "`");
    let sub = eval("`" + s2 + "`");

    fetch("../../actions/send_mail.php", {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify({
        to: mail,
        sub,
        msg,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
      });
    console.log(msg);
  }
};

var userMailSubmit = (toAll = false) => {
  composeWindow.container.style.display = "none";
  let t = data.users;
  if (!toAll) {
    let indexes = composeWindow.selectUser1.val();
    let temp = [];
    for (let i of indexes) {
      temp.push(t[i]);
    }
    t = temp;
  }

  let s1 = composeWindow.content.value
    .replace(/\\/g, "")
    .replace(/`/g, "\\`")
    .replace(
      "<blockquote>",
      '<blockquote style="border-left: 0.7rem solid #007bff;margin: 1.5em 0.7rem;padding: 0.5em 0.7rem;">'
    );

  let s2 = composeWindow.subject.value.replace(/\\/g, "").replace(/`/g, "\\`");

  console.log(s1);

  for (let i of t) {
    let name = i.user_name;
    let mail = i.user_mail;
    let phone = i.user_phone;
    let time = i.user_time;
    let msg = eval("`" + s1 + "`");
    let sub = eval("`" + s2 + "`");
    fetch("../../actions/send_mail.php", {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify({
        to: mail,
        sub,
        msg,
      }),
    })
      .then((res) => res.text())
      .then((data) => {
        console.log(data);
      });
  }
};

//  util operations
const util = {
  classify(objArr, by) {
    let out = {};
    for (let i of objArr) (out[i[by]] || (out[i[by]] = [])).push(i);
    return out;
  },
  isEqual(a, b) {
    if (Object.keys(a).length !== Object.keys(b).length) return false;
    for (let i in a) if (a[i] != b[i]) return false;
    return true;
  },
  changeIndex(a, b) {
    let o = [];
    for (let i in a) if (!this.isEqual(a[i], b[i])) o.push(i);
    return o;
  },
  findFirst(objArr, key, value) {
    for (let i of objArr) {
      if (i[key] == value) return i;
    }
    return {};
  },
  getEvtNames(str = " ", user_id) {
    let s = str.split(", ");
    s.sort();
    let t = [];
    for (let i of s) {
      if (i.length > 1) {
        t.push(
          `<a href="#" onclick="goToModal('candidate','${i.trim()}','${user_id}')">${
            data.events[i.trim()][0].name
          }</a>`
        );
      }
    }
    return t.join(", ");
  },
};
