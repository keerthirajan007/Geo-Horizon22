var data = {
  contacts: {},
  events: {},
  reg_events: [],
};

var upper_space = document.getElementById("upper-space");
var colors = ["blue", "orange", "green", "red", "purple", "pink"];
var status_mapper = {
  red: "#ff00007a",
  green: "#0080008c",
  yellow: "#ffff0094",
};

var dom = {
  home: {
    container: document.getElementById("home"),
  },
  event: {
    container: document.getElementById("event"),
    technical_event: document.getElementById("technical-event-content"),
    non_technical_event: document.getElementById("non-technical-event-content"),
  },
  workshop: {
    container: document.getElementById("workshop"),
    content: document.getElementById("workshop-content"),
  },
  expandModal: {
    container: document.getElementById("expand-modal"),
    content: document.getElementById("expand-modal-content"),
    title: document.getElementById("expand-modal-title"),
    register: document.getElementById("expand-modal-register"),
  },
  about: {
    container: document.getElementById("about"),
  },
  team: {
    container: document.getElementById("team"),
  },
  sponsors: {
    container: document.getElementById("sponsors"),
  },
  profile: {
    container: document.getElementById("profile"),
    reg_table_body: document.getElementById("reg-table-body"),
    profile_table: document.getElementById("profile-table"),
  },
  features: {
    container: document.getElementById("features"),
  },
  accommodation: {
    container: document.getElementById("accommodation"),
  },
};

dom.expandModal.switch = $(dom.expandModal.container);

window.addEventListener("load", async (e) => {
  data = await getRequiredData();
  setContacts();
  setEvents();
  await setProfile();
});

async function getRequiredData() {
  var v2 = await (await fetch("../../actions/get_events.php")).json();

  return {
    events: util.classify(v2, "event_type"),
  };
}

function setMainContent(tab) {
  dom.home.container.style.display = "none";
  dom.about.container.style.display = "none";
  dom.sponsors.container.style.display = "none";
  dom.event.container.style.display = "none";
  dom.workshop.container.style.display = "none";
  dom.team.container.style.display = "none";
  dom.features.container.style.display = "none";
  dom.profile.container.style.display = "none";
  dom.accommodation.container.style.display = "none";
  upper_space.style.padding = "1rem";

  if (tab == "home") {
    upper_space.style.padding = "0rem";
    dom.features.container.style.display = "inherit";
    dom.home.container.style.display = "flex";
    // dom.sponsors.container.style.display = "inherit";
    dom.event.container.style.display = "inherit";
    dom.accommodation.container.style.display = "inherit";
    dom.workshop.container.style.display = "inherit";
    // dom.team.container.style.display = "inherit";
    dom.about.container.style.display = "inherit";
  } else if (tab == "about") {
    dom.about.container.style.display = "inherit";
  } else if (tab == "event") {
    dom.accommodation.container.style.display = "inherit";
    dom.event.container.style.display = "inherit";
  } else if (tab == "workshop") {
    dom.accommodation.container.style.display = "inherit";
    dom.workshop.container.style.display = "inherit";
  } else if (tab == "sponsors") {
    dom.sponsors.container.style.display = "inherit";
  } else if (tab == "team") {
    dom.team.container.style.display = "inherit";
  } else if (tab == "features") {
    dom.features.container.style.display = "inherit";
  } else if (tab == "profile") {
    dom.profile.container.style.display = "flex";
  }
  AOS.refreshHard();
  let x = document.getElementById("mobile-toggle");
  if (x && x.classList.contains("bi-x")) {
    x.click();
  }
}

// set the organizers and staffs
function setContacts() {}

// set the events and workshops
function setEvents() {
  // set tech
  // set non-tech
  // set carnival
  let str = "";
  let count = 0;
  data.events["event-non-technical"].forEach((e, i) => {
    if (count == colors.length) count = 0;
    str += `<div style="cursor: pointer;" class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-box ${colors[count++]}">
        <i class="${e.icon_class} icon"></i>
        <h3>${e.name}</h3>
        <p>
          ${e.short}
        </p>
        <span style="cursor: pointer;" onclick="setEventModal('event-non-technical',${i})" href="#" class="read-more">
          <span>Register</span> <i class="bi bi-arrow-right"></i>
        </span>
      </div>
    </div>`;
  });
  dom.event.non_technical_event.innerHTML = str;

  str = "";
  count = 0;
  data.events["event-technical"].forEach((e, i) => {
    if (count == colors.length) count = 0;
    str += `<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-box ${colors[count++]}">
        <i class="${e.icon_class} icon"></i>
        <h3>${e.name}</h3>
        <p>
          ${e.short}
        </p>
        <span style="cursor: pointer;" onclick="setEventModal('event-technical',${i})" href="#" class="read-more">
          <span>Register</span> <i class="bi bi-arrow-right"></i>
        </span>
      </div>
    </div>`;
  });

  dom.event.technical_event.innerHTML = str;

  str = "";
  count = 0;
  data.events["workshop"].forEach((e, i) => {
    if (count == colors.length) count = 0;
    str += `
    <div class="testimonial-item">
      <div class="profile mt-auto">
        <span class="testimonial-img"><i style="font-size: 36px;padding: 40px 20px;border-radius: 4px;position: relative;margin-bottom: 25px;display: inline-block;line-height: 0;transition: 0.3s;color:${
          colors[count++]
        }" class="${e.icon_class}" ></i></span>        
        <h3>${e.name}</h3>
      </div>
      <p>
      ${e.short}
    </p>
    <span style="cursor: pointer;" onclick="setEventModal('workshop',${i})" href="#" class="read-more">
          <span><b style="font-size:1.5 rem">Register</b></span> <i class="bi bi-arrow-right"></i>
        </span>
    </div>`;
  });

  dom.workshop.content.innerHTML = str;
}

async function getProfileDetails() {
  return await (
    await fetch(
      "../../actions/get_users.php?condition=user_id='" + profile.user_id + "'"
    )
  ).json();
}

async function setProfile() {
  profile = await getProfileDetails();
  profile = profile[0];

  data.reg_events = await (
    await fetch(
      "../../actions/get_candidates.php?condition=c.user_id='" +
        profile.user_id +
        "'"
    )
  ).json();

  dom.profile.profile_table.innerHTML = `
    <tr>
      <td>User Name</td>
      <th>: ${profile.user_name}</th>
    </tr>
    <tr>
      <td>Mobile</td>
      <th>: ${profile.user_phone}</th>
    </tr>
    <tr>
      <td>Email</td>
      <th>: ${profile.user_mail}</th>
    </tr>
    <tr>
      <td>Amount Required</td>
      <th>:₹ ${profile.amt_required}</th>
    </tr>
    <tr>
      <td colspan="2">It includes fees for Non Technical events and Workshops.If you registered technical events,general participation amount(₹ 50) is also included</td>
    </tr>
    <tr>
      <td>Amount Paid</td>
      <th>:₹ ${profile.amt_paid}</th>
    </tr>
  `;

  if (data.reg_events.length > 0) {
    let str = "";
    data.reg_events.forEach((e, i) => {
      if ((e.event_type = "event-technical")) {
        str += `<tr><td>${
          e.name
        }</td><td>Technical</td><td style="background-color:${
          status_mapper[e.status]
        };" >${e.remark}</td></tr>`;
      } else if ((e.event_type = "event-technical")) {
        str += `<tr><td>${e.name}(${
          e.event_amt
        })</td><td>Non-Technical</td><td style="background-color:${
          status_mapper[e.status]
        };" >${e.remark}</td></tr>`;
      } else if ((e.event_type = "workshop")) {
        str += `<tr><td>${e.name}(${
          e.event_amt
        })</td><td>Workshop</td><td style="background-color:${
          status_mapper[e.status]
        };" >${e.remark}</td></tr>`;
      }
    });
    dom.profile.reg_table_body.innerHTML = str;
  } else {
    dom.profile.reg_table_body.innerHTML =
      "<tr><td colspan='2'>You are not registered any events </td></tr>";
  }
}

//
function setEventModal(event_type, index) {
  dom.expandModal.register.className = "btn btn-flat btn-custom-blue";
  dom.expandModal.register.innerHTML = "Confirm";
  dom.expandModal.register.disabled = false;

  var e = data.events[event_type][index];
  dom.expandModal.title.innerHTML = `${e.name}`;
  // set data
  // open modal
  if (event_type != "event-technical") {
    dom.expandModal.content.innerHTML = `
              <div class="d-flex flex-row flex-wrap justify-content-center align-items-center">
                  <div class="card-header f-flex justify-content-center">
                      <img height="100%" width="100%" class="card-img-top" src="../../uploads/events/${e.image_path}" style="max-height: 300px;max-width: 400px;"/>
                  </div>
                  <div class="card-body">    
                      <div class="row">
                          <dd class="col-12">${e.description}</dd>
                          <dt class="col-sm-4">Amount </dt>
                          <dd class="col-sm-8">${e.amount} INR</dd>
                          <dt class="col-sm-4">Venue</dt>
                          <dd class="col-sm-8">${e.venue}</dd>
                          <dt class="col-sm-4">DateTime</dd>
                          <dd class="col-sm-8">${e.date_time}</dd>
                          <dt class="col-sm-4">Organizer</dd>
                          <dd class="col-sm-8">${e.organizer}</dd>
                        </div>
                  </div>
              </div>`;
  } else {
    dom.expandModal.content.innerHTML = `
              <div class="d-flex flex-row flex-wrap justify-content-center align-items-center">
                  <div class="card-header f-flex justify-content-center">
                      <img height="100%" width="100%" class="card-img-top" src="../../uploads/events/${e.image_path}" style="max-height: 300px;max-width: 400px;"/>
                  </div>
                  <div class="card-body">    
                      <div class="row">
                          <dd class="col-12">${e.description}</dd>
                          <dt class="col-sm-4">Venue</dt>
                          <dd class="col-sm-8">${e.venue}</dd>
                          <dt class="col-sm-4">DateTime</dd>
                          <dd class="col-sm-8">${e.date_time}</dd>
                          <dt class="col-sm-4">Organizer</dd>
                          <dd class="col-sm-8">${e.organizer}</dd>
                      </div>
                  </div>
              </div>`;
  }
  dom.expandModal.switch.modal("show");
  dom.expandModal.register.onclick = () => register(e.event_id);
}

// logic for register the event (redirect to sign in)
function register(event_id) {
  dom.expandModal.register.disabled = true;
  dom.expandModal.register.innerHTML = `<span style="width:1.5rem;height:1.5rem;" class="spinner-border text-light" role="status">
      <span class="sr-only">Loading...</span>
      </span> Registering`;

  fetch("../../actions/register.php", {
    headers: {
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify({
      user_id: profile.user_id,
      event_id: event_id,
    }),
  })
    .then((res) => res.json())
    // .then((res) => res.text())
    .then(async (data) => {
      console.log(data);
      dom.expandModal.register.disabled = false;
      if (data.code == "1") {
        // successful
        dom.expandModal.register.className = "btn btn-success btn-flat";
        dom.expandModal.register.innerHTML =
          "<i class='far fa-check-circle'></i> Registered successfully";
        await setProfile();
      } else if (data.code == "2") {
        // already registered
        dom.expandModal.register.className = "btn btn-success btn-flat";
        dom.expandModal.register.innerHTML =
          "<i class='far fa-check-circle'></i> Already Registered";
      } else {
        // failed
        dom.expandModal.register.className = "btn btn-danger btn-flat";
        dom.expandModal.register.innerHTML =
          "<i class='far fa-times-circle'></i> Registration Failed";
        warningModal.content.innerHTML = `Registration is failed due to '${data.reason}'`;
        warningModal.switch.modal("show");
      }
      dom.expandModal.register.onclick = () => {
        dom.expandModal.switch.modal("hide");
        dom.expandModal.register.hidden = true;
      };
    });
}

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
};

setMainContent("home");
