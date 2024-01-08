

let day1 = "2023-01-01,2024-12-31";

// console.log(day1.replace('-','/'));

const regex = /-/g;
day1=day1.replace(regex, '/');
// console.log(day1);
let nameyear = "2024";

let a1 = day1.split(",");

let b1 = Array();

b1.push(a1[0].split("/"));
b1.push(a1[1].split("/"));

let newDate = Array();

let sDate;
let fDate;

if(b1[0][0] == b1[1][0]) {
  newDate.push(day1);
} else {
  calculateDiff = b1[1][0] - b1[0][0]; // year difference 
  // 3= 0,1,2
  // console.log(calculateDiff);
  for(let i=0; i<=calculateDiff; i++) {
    res = parseInt(b1[0][0])+i;
    if(i == 0) {
      sDate = res+"/"+b1[0][1]+"/"+b1[0][2]; // 2023-12-31
      // console.log(sDate);
      eDate = res+"/12/31"; // 2023-12-31
      fDate = sDate+","+eDate; // 2023-12-31, 2023-12-31
      newDate.push(fDate);
    } else if(i==calculateDiff) {
      sDate = res+"/01/01";
      eDate = b1[1][0]+"/"+b1[1][1]+"/"+b1[1][2]; // 2023-12-31
      fDate = sDate+","+eDate;
      newDate.push(fDate);
    } else {
      sDate = res+"/01/01";
      eDate = res+"/12/31";
      fDate = sDate+","+eDate;
      newDate.push(fDate);
    }
    
    // console.log(res);
  }
}
// console.log(newDate);
var newdate1 = Array();
let length = newDate.length;
let a;
// console.log(length)

for (i=0; i<length; i++) {
  
  let splitting = newDate[i].split(",");
  // console.log(splitting);
  let length1 = splitting.length;

  for (j=0;j<length1;j++){
      
     a = (splitting[j].search(nameyear));
    // console.log(splitting[j]);
    
    if (a>=0){
      newdate1.push(splitting[j]);
      
    }
  }
}

let newq = Array();


newq.push(newdate1[0].split("/"));
newq.push(newdate1[1].split("/"));
// console.log(newq[1][0]);

// let aaa = new Date(newdate1[0]);
// let bbb = new Date(newdate1[1]);
// let month = aaa.getMonth();
// let day = aaa.getDate();
// let dayfinal = bbb.getDate();
// let month1 = bbb.getMonth();


let year = parseInt(newq[0][0]);
// console.log(year);
let stdate;
let endDate;
let mm;
let m;
let stardtdatearr = Array();
let endDatear = Array();
let endDate2;
let leapyear;
let final;
for(i = parseInt(newq[0][1]); i <= parseInt(newq[1][1]); i++) {
  
    if(i==parseInt(newq[0][1])) {
      stdate = newq[0][0]+"/"+newq[0][1]+"/"+newq[0][2];
      // console.log(stdate);
      stardtdatearr.push(stdate);
      
    }
    
    else {
       stdate = newq[0][0]+"/"+i+"/01";
      // console.log(stdate);
      stardtdatearr.push(stdate);
    }
    

 if(i <= parseInt(newq[1][1])) {
      
      switch (i) {
      
        case 1: 
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:  
          if(i==(parseInt(newq[1][1]))) {
            endDate = newq[1][0]+"/"+i+"/"+newq[1][2];
            final = stdate+","+endDate;
            // console.log(final);
            endDatear.push(final);
          }
          else {
            endDate = newq[0][0]+"/"+i+"/31";
            final = stdate+","+endDate;
            // console.log(final);
            endDatear.push(final);
          }
          
          break;
 
        
        case 4:
        case 6:
        case 9:
        case 11:  
           endDate = newq[0][0]+"/"+i+"/30";
            final = stdate+","+endDate;
          // console.log(final);
          endDatear.push(final);break;
        
        case 2: 
          if(i==(parseInt(newq[1][1]))) {
            endDate = newq[0][0]+"/"+i+"/"+newq[1][2];
            final = stdate+","+endDate;
            // console.log(final);
            endDatear.push(final);
          }

          else {
            if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)) {
              leapyear = newq[0][0]+"/"+i+"/29";
            }
          
            else {
             leapyear = newq[0][0]+"/"+i+"/28";
            }
             final = stdate+","+leapyear;
              endDatear.push(final);
          }
            
            // final = stdate+","+leapyear;
            // // console.log(final);
            // endDatear.push(final);
            
          break;
        
        default: break;
        
      }
    }
  }

// console.log(endDatear);
let lengthend = endDatear.length;

// console.log(lengthend);


let firstday, lastday, splited, diff, daydiff, dayadd;

let arr = Array(0,0,0,0,0,0,0,0,0,0,0,0);

let day = Array();

for(i=0; i<lengthend; i++){
  // console.log(i);
  firstday=0;
  lastday=0;

  
  splited = endDatear[i].split(",");

  firstday = new Date(splited[0]);
  
  lastday = new Date(splited[1]);
  // console.log(firstday);


    
  diff = lastday.getTime() - firstday.getTime();   
    
  daydiff = diff / (1000 * 60 * 60 * 24);   
    
  dayadd =daydiff+1;

  // console.log(dayadd);
  
  let a = firstday.getMonth();
  
  // console.log(a);
  
  arr.splice(a, 1, dayadd);
  

}


let q1=q2=q3=q4=yeardays=0;

for(i=0; i<12; i++) {
  if(i>=0 && i<=2) {
    q1 += arr[i];
  } else if(i>=3 && i<=5) {
    q2 += arr[i];
  } else if(i>=6 && i<=8) {
    q3 += arr[i];
  } else {
    q4 += arr[i];
  }
}

yeardays =q1+q2+q3+q4;
console.log(`No of days in year ${nameyear} is ${yeardays}`);

console.log(`No of days in q1 of year ${nameyear} is ${q1}`);
console.log(`No of days in q2 of year ${nameyear} is ${q2}`);
console.log(`No of days in q3 of year ${nameyear} is ${q3}`);
console.log(`No of days in q4 of year ${nameyear} is ${q4}`);
console.log(arr);




// console.log(endDatear);

// console.log(newdate1);

